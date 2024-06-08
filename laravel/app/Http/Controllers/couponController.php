<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Coupon;

class couponController extends Controller
{
    public function index(){
        return view('BackEnd.coupon.add');
    }


    public function save(Request $request){

        $validator = Validator::make($request->all(), [
            'coupon_type' => 'required|integer',
            'coupon_value' => 'required|integer',
            'cart_min_value' => 'required|integer',
            'coupon_status' => 'required|integer',
            'expire_on' => 'required|date',
            'added_on' => 'required|date', 
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400); 
        }

        $expireOn = Carbon::parse($request->expire_on);
        $addedOn = Carbon::parse($request->added_on);
        if ($expireOn->lt($addedOn)) {
            return response()->json(['error' => 'The expiration date must be after the added date.'], 400);
        }
        
        try {
            $coupon = Coupon::create($request->all());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'An error occurred while saving the coupon.');
        }
        
        return back()->with('sms','Saved Successfully');
    }

    public function manage(){
        $coupons = Coupon::all();
        return view('BackEnd.coupon.manage',compact('coupons'));
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return redirect()->route('manage_coupon')->with('error', 'Coupon not found.');
        }

        return view('coupons.edit', compact('coupon'));
    }

    // Method to update a coupon
    public function update(Request $request, $id)
    {
        $request->validate([
            'coupon_type' => 'required|integer',
            'coupon_value' => 'required|integer',
            'cart_min_value' => 'required|integer',
            'coupon_status' => 'required|integer',
            'expire_on' => 'required|date',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        return redirect()->route('manage_coupon')->with('success', 'Coupon updated successfully.');
    }

    // Method to delete a coupon
    public function delete($id)
    {
        $coupon = Coupon::find($id);

        if ($coupon) {
            $coupon->delete();
            return redirect()->route('manage_coupon')->with('success', 'Coupon deleted successfully.');
        } else {
            return redirect()->route('manage_coupon')->with('error', 'Coupon not found.');
        }
    }

    // Method to change the status of a coupon
    public function changeStatus($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found'], 404);
        }

        $coupon->coupon_status = $coupon->coupon_status == 1 ? 0 : 1;
        $coupon->save();

        return response()->json(['coupon_status' => $coupon->coupon_status]);
    }
}