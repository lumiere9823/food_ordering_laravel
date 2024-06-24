<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{

    public function checkCall(Request $request)
    {
        $needle = $request->needle;

        if (!$needle || $needle === "" || $needle === "undefined" || $needle === 0) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Needle is required',
            ]);
        }

        try {
            $match = false;

            (new BIDVBankController)->syncTransaction();

            $data = BankTransaction::where('type', 1)
                ->where('checked', false)
                ->where('content', 'like', "%" . $needle . "%")
                ->get();

            $qr = \App\Models\QrCode::where('code', $needle)->first();

            foreach ($data as $transaction) {
                if ($qr->amount <= $transaction->amount) {
                    $match = true;
                    $transaction->checked = true;
                    $transaction->save();

                    $qr->transaction_id = $transaction->id;
                    $qr->checked = true;
                    $qr->updated_at = Carbon::now();
                    $qr->save();
                }
            }

            if ($data->count() > 0) {
                event(new \App\Events\PushScreenData(0, 'payment_received', []));
                event(new \App\Events\PushScreenData(1, 'payment_received', []));

                return response()->json([
                    'success' => true,
                    'data' => $data,
                    'message' => 'Transactions found and processed',
                    'match' => $match,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'message' => 'No unchecked transactions found',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Check Call Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function generateQR(Request $request)
    {
        $amount = $request->amount;

        if ($amount <= 0) {
            return response()->json([
                'success' => false,
                'uuid' => null,
                'message' => 'Invalid amount',
            ]);
        }

        $qr = new \App\Models\QrCode();
        $qr->amount = $amount;
        $qr->code = "POS" . \Illuminate\Support\Str::random(6);
        $qr->uuid = \Illuminate\Support\Str::uuid();
        $qr->content = "";
        $qr->save();

        return response()->json([
            'success' => true,
            'uuid' => $qr->uuid,
            'message' => 'QR code generated successfully',
        ]);
    }

    public function displayQR(Request $request)
    {
        try {
            $qr = \App\Models\QrCode::where('uuid', $request->uuid)->first();

            if (!$qr) {
                return response()->json([
                    'success' => false,
                    'message' => 'QR code not found',
                ], 404);
            }

            $bank = BankAccount::find(1);
            if (!$bank) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bank account not found',
                ], 404);
            }

            $bankCode = $bank->bank;
            $bankAccount = $bank->bank_number;
            $message = $qr->code;
            $hash = $this->generate_string_hash($bankCode, $bankAccount, $qr->amount, $message);

            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate($hash);
            $qrCodeBase64 = base64_encode($qrCode);

            return response()->json([
                'success' => true,
                'qrCode' => $qrCodeBase64,
                'message' => 'QR code generated successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('Display QR Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public static function genQRUUID($amount)
    {
        $qr = new \App\Models\QrCode();
        $qr->amount = $amount;
        $qr->code = "POS" . \Illuminate\Support\Str::random(6);
        $qr->uuid = \Illuminate\Support\Str::uuid();
        $qr->content = "";
        $qr->save();

        return $qr;
    }

    public static function dispQr($amount, $bank_id)
    {
        // Validate inputs
        if ($amount <= 0 || !$bank_id) {
            return false;
        }

        // Find bank account by ID
        $bank = BankAccount::find($bank_id);
        if (!$bank) {
            return false;
        }

        // Generate a QR code UUID
        $qr = TransactionController::genQRUUID($amount);
        $bankCode = $bank->bank;
        $bankAccount = $bank->bank_number;
        $message = $qr->code;

        // Generate hash for QR code content
        $hash = (new TransactionController)->generate_string_hash($bankCode, $bankAccount, $qr->amount, $message);

        // Generate QR code image
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::style('round')->size(300)->generate($hash);

        return ['needle' => $qr->code, 'qr' => $qrCode];
    }

    /**
     * Generate a checksum for the given text.
     *
     * @param string $text
     * @return string
     */
    private function generateCheckSum($text)
    {
        $crc = 0xFFFF;          // initial value
        $polynomial = 0x1021;   // 0001 0000 0010 0001  (0, 5, 12)
        $bytes = str_split($text);
        foreach ($bytes as $b) {
            $b = ord($b); // Get the ASCII value of the character
            for ($i = 0; $i < 8; $i++) {
                $bit = (($b >> (7 - $i)) & 1) == 1;
                $c15 = (($crc >> 15) & 1) == 1;
                $crc <<= 1;
                if ($c15 ^ $bit) {
                    $crc ^= $polynomial;
                }
            }
        }
        return dechex($crc & 0xFFFF);
    }

    private function generate_string_hash($bankCode, $bankAccount, $amount, $message): string
    {
        $bankIdByCode = array(
            "BIDV" => "970418"
        );

        if (!isset($bankIdByCode[$bankCode])) {
            throw new \Exception("Unsupported bank code: $bankCode");
        }

        $bankId = $bankIdByCode[$bankCode];
        $part12Builder = "00" . sprintf("%02d", strlen($bankId)) . $bankId . "01" . sprintf("%02d", strlen($bankAccount)) . $bankAccount;
        $part11Builder = "0010A000000727" . "01" . sprintf("%02d", strlen($part12Builder)) . $part12Builder . "0208QRIBFTTA";
        $part1Builder = "38" . sprintf("%02d", strlen($part11Builder)) . $part11Builder;
        $part21Builder = "08" . sprintf("%02d", strlen($message)) . $message;
        $part2 = "5303704" . "54" . sprintf("%02d", strlen($amount)) . $amount . "5802VN" . "62" . sprintf("%02d", strlen($part21Builder)) . $part21Builder;
        $builder = "000201" . "010212" . $part1Builder . $part2 . "6304";

        return $builder . strtoupper($this->generateCheckSum($builder));
    }

}