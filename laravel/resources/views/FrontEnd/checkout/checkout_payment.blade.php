@extends('FrontEnd.cart_master')

@section('title', 'Checkout')

@section('content')
    <div class="products">
        <div class="container">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6 product-w3ls"
                    style="box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5); border-radius: 16px; padding:30px">
                    <div class="card">
                        <div class="card-header text-muted">
                            <h4>Checkout</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Dear {{ Session::get('customer_name') }}</h3>
                                    <h4 class="text-center" style="padding: 20px">We need to know which payment method you
                                        prefer.</h4>
                                </div>
                            </div>
                            <div class="card mt-4">
                                <h5 class="card-header mt-4 text-center text-muted">
                                    Please select your payment method
                                </h5>
                                <div class="card-body">
                                    <div class="checkout-left">
                                        <div class="address_form_agile mt-sm-5 mt-4">
                                            <form id="paymentForm" action="{{ route('new_order') }}" method="post">
                                                @csrf
                                                <table class="table">
                                                    <tr>
                                                        <th>Cash On Delivery</th>
                                                        <td>
                                                            <input type="radio" name="payment_type" value="Cash"
                                                                required onclick="toggleQRCode(false)">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Online Payment</th>
                                                        <td>
                                                            <input type="radio" name="payment_type" value="Qr"
                                                                onclick="handleOnlinePayment()">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-center">
                                                            <input type="submit" name="btn" class="btn btn-primary"
                                                                value="Confirm Order">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vertical Line Separator -->
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                    <div style="border-left: 2px solid #000; height: 100%;"></div>
                </div>
                <!-- Right Column -->
                <div class="col-md-5 product-w3ls">
                    <div id="qrCodeContainer" class="card mt-4" style="display:none;">
                        <div class="card-header text-muted">
                            <h5>QR Code for Online Payment</h5>
                        </div>
                        <div id="qrCodeImage" class="card-body text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function handleOnlinePayment() {
            // Make Ajax request to fetch QR code
            $.ajax({
                url: "{{ route('generate_qr') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    amount: 1000
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        console.log('QR code generated with UUID: ' + response.uuid);
                        displayQRCode(response.uuid);
                    } else {
                        console.error('Failed to generate QR code: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        }

        function displayQRCode(uuid) {
            var qrCodeCard = document.getElementById('qrCodeContainer');
            $.ajax({
                url: "{{ route('display_qr') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    uuid: uuid,
                    bank_id: 1
                },
                success: function(response) {
                    if (response.success) {
                        $('#qrCodeContainer').show();
                        qrCodeCard.innerHTML = `
                        <h5>QR Code for Online Payment</h5>
                        <p>Scan this QR code to proceed with the payment.</p>
                        <?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="300" height="300" viewBox="0 0 300 300"><rect x="0" y="0" width="300" height="300" fill="#ffffff"/><g transform="scale(8.108)"><g transform="translate(0,0)"><path fill-rule="evenodd" d="M12 0L12 2L13 2L13 1L15 1L15 2L14 2L14 5L15 5L15 6L14 6L14 7L15 7L15 8L14 8L14 9L13 9L13 4L11 4L11 3L8 3L8 4L9 4L9 5L8 5L8 7L9 7L9 8L6 8L6 9L5 9L5 8L0 8L0 9L1 9L1 10L0 10L0 13L2 13L2 12L3 12L3 13L7 13L7 14L6 14L6 15L5 15L5 14L3 14L3 15L0 15L0 16L1 16L1 17L0 17L0 19L2 19L2 20L1 20L1 21L0 21L0 22L1 22L1 23L0 23L0 24L1 24L1 25L0 25L0 29L1 29L1 25L3 25L3 24L1 24L1 23L4 23L4 22L6 22L6 23L5 23L5 24L6 24L6 25L8 25L8 26L6 26L6 27L8 27L8 28L10 28L10 29L11 29L11 30L12 30L12 31L11 31L11 32L10 32L10 33L9 33L9 32L8 32L8 37L10 37L10 36L11 36L11 37L13 37L13 35L14 35L14 33L15 33L15 35L16 35L16 36L14 36L14 37L17 37L17 35L18 35L18 36L20 36L20 37L21 37L21 36L24 36L24 35L25 35L25 33L21 33L21 32L23 32L23 31L22 31L22 29L23 29L23 30L24 30L24 32L25 32L25 30L26 30L26 29L28 29L28 31L26 31L26 33L27 33L27 34L26 34L26 35L28 35L28 36L26 36L26 37L28 37L28 36L29 36L29 35L30 35L30 37L31 37L31 36L34 36L34 37L37 37L37 34L34 34L34 33L35 33L35 32L34 32L34 31L33 31L33 30L34 30L34 29L35 29L35 30L36 30L36 32L37 32L37 30L36 30L36 29L37 29L37 26L36 26L36 25L37 25L37 22L36 22L36 21L37 21L37 18L36 18L36 17L37 17L37 16L36 16L36 17L35 17L35 16L34 16L34 13L35 13L35 14L36 14L36 15L37 15L37 14L36 14L36 13L37 13L37 10L36 10L36 8L35 8L35 10L36 10L36 13L35 13L35 12L34 12L34 11L33 11L33 12L31 12L31 10L30 10L30 8L28 8L28 7L29 7L29 6L28 6L28 5L27 5L27 4L29 4L29 3L28 3L28 2L29 2L29 1L27 1L27 0L26 0L26 1L27 1L27 2L26 2L26 3L25 3L25 1L24 1L24 3L23 3L23 2L22 2L22 1L23 1L23 0L21 0L21 3L20 3L20 4L19 4L19 2L18 2L18 3L16 3L16 1L15 1L15 0ZM19 0L19 1L20 1L20 0ZM8 1L8 2L9 2L9 1ZM10 1L10 2L11 2L11 1ZM24 3L24 4L25 4L25 5L26 5L26 6L25 6L25 8L24 8L24 5L21 5L21 4L20 4L20 5L19 5L19 4L15 4L15 5L16 5L16 6L15 6L15 7L16 7L16 8L15 8L15 9L14 9L14 10L16 10L16 12L18 12L18 10L19 10L19 13L15 13L15 14L14 14L14 11L13 11L13 9L12 9L12 8L10 8L10 9L9 9L9 10L10 10L10 9L11 9L11 11L10 11L10 12L11 12L11 13L10 13L10 15L9 15L9 13L8 13L8 15L6 15L6 16L8 16L8 17L6 17L6 18L7 18L7 19L5 19L5 18L4 18L4 17L3 17L3 20L2 20L2 21L3 21L3 20L5 20L5 21L6 21L6 22L7 22L7 23L6 23L6 24L8 24L8 25L10 25L10 26L8 26L8 27L10 27L10 28L11 28L11 29L13 29L13 30L16 30L16 31L15 31L15 33L17 33L17 34L16 34L16 35L17 35L17 34L19 34L19 35L20 35L20 36L21 36L21 35L20 35L20 34L21 34L21 33L20 33L20 32L21 32L21 29L20 29L20 28L21 28L21 27L20 27L20 26L21 26L21 25L20 25L20 24L19 24L19 23L20 23L20 22L21 22L21 21L20 21L20 20L21 20L21 19L22 19L22 20L23 20L23 21L25 21L25 24L24 24L24 22L23 22L23 23L22 23L22 24L23 24L23 25L25 25L25 26L23 26L23 27L22 27L22 28L23 28L23 29L26 29L26 28L27 28L27 26L28 26L28 28L30 28L30 26L31 26L31 28L32 28L32 27L33 27L33 25L34 25L34 26L35 26L35 27L34 27L34 28L33 28L33 29L34 29L34 28L35 28L35 29L36 29L36 26L35 26L35 25L36 25L36 22L35 22L35 21L36 21L36 18L35 18L35 17L34 17L34 16L33 16L33 13L34 13L34 12L33 12L33 13L30 13L30 12L29 12L29 13L27 13L27 12L28 12L28 11L27 11L27 10L29 10L29 11L30 11L30 10L29 10L29 9L27 9L27 7L28 7L28 6L27 6L27 5L26 5L26 4L27 4L27 3L26 3L26 4L25 4L25 3ZM10 4L10 6L9 6L9 7L10 7L10 6L11 6L11 7L12 7L12 5L11 5L11 4ZM18 5L18 7L19 7L19 5ZM16 6L16 7L17 7L17 6ZM20 6L20 9L19 9L19 8L16 8L16 9L19 9L19 10L20 10L20 13L19 13L19 14L18 14L18 16L15 16L15 15L17 15L17 14L15 14L15 15L14 15L14 14L13 14L13 13L11 13L11 14L13 14L13 15L12 15L12 16L11 16L11 15L10 15L10 16L11 16L11 17L9 17L9 18L12 18L12 19L13 19L13 18L14 18L14 19L15 19L15 20L13 20L13 21L11 21L11 22L12 22L12 24L13 24L13 21L19 21L19 22L20 22L20 21L19 21L19 18L20 18L20 17L21 17L21 18L22 18L22 19L23 19L23 18L24 18L24 20L25 20L25 21L26 21L26 23L27 23L27 24L26 24L26 25L29 25L29 26L30 26L30 25L33 25L33 24L34 24L34 25L35 25L35 24L34 24L34 21L35 21L35 20L34 20L34 19L33 19L33 18L34 18L34 17L33 17L33 16L31 16L31 14L30 14L30 13L29 13L29 14L30 14L30 16L27 16L27 17L26 17L26 16L25 16L25 13L26 13L26 14L27 14L27 15L28 15L28 14L27 14L27 13L26 13L26 12L25 12L25 9L26 9L26 10L27 10L27 9L26 9L26 8L25 8L25 9L23 9L23 8L22 8L22 7L23 7L23 6L22 6L22 7L21 7L21 6ZM26 6L26 7L27 7L27 6ZM31 8L31 9L32 9L32 8ZM33 8L33 10L34 10L34 8ZM3 9L3 10L4 10L4 11L3 11L3 12L4 12L4 11L5 11L5 12L7 12L7 11L8 11L8 10L7 10L7 9L6 9L6 10L4 10L4 9ZM20 9L20 10L22 10L22 11L24 11L24 10L23 10L23 9ZM1 10L1 11L2 11L2 10ZM6 10L6 11L7 11L7 10ZM11 11L11 12L12 12L12 11ZM23 12L23 13L22 13L22 14L21 14L21 13L20 13L20 14L19 14L19 17L14 17L14 15L13 15L13 16L12 16L12 17L14 17L14 18L17 18L17 19L16 19L16 20L18 20L18 18L19 18L19 17L20 17L20 15L22 15L22 16L23 16L23 17L22 17L22 18L23 18L23 17L25 17L25 20L26 20L26 21L27 21L27 22L28 22L28 24L29 24L29 25L30 25L30 22L31 22L31 23L32 23L32 24L33 24L33 21L34 21L34 20L33 20L33 19L32 19L32 18L33 18L33 17L31 17L31 20L33 20L33 21L30 21L30 20L29 20L29 21L27 21L27 20L28 20L28 19L27 19L27 18L29 18L29 19L30 19L30 17L27 17L27 18L26 18L26 17L25 17L25 16L24 16L24 14L23 14L23 13L25 13L25 12ZM4 15L4 16L5 16L5 15ZM8 15L8 16L9 16L9 15ZM1 17L1 18L2 18L2 17ZM7 19L7 20L6 20L6 21L7 21L7 22L9 22L9 24L10 24L10 25L11 25L11 26L13 26L13 27L11 27L11 28L13 28L13 29L19 29L19 30L18 30L18 32L17 32L17 31L16 31L16 32L17 32L17 33L19 33L19 34L20 34L20 33L19 33L19 30L20 30L20 29L19 29L19 28L20 28L20 27L19 27L19 26L20 26L20 25L19 25L19 24L15 24L15 23L16 23L16 22L15 22L15 23L14 23L14 26L13 26L13 25L11 25L11 23L10 23L10 22L9 22L9 21L10 21L10 20L11 20L11 19L10 19L10 20L9 20L9 21L8 21L8 19ZM29 21L29 22L30 22L30 21ZM15 25L15 26L14 26L14 27L13 27L13 28L14 28L14 27L15 27L15 28L16 28L16 27L17 27L17 28L18 28L18 26L19 26L19 25L18 25L18 26L17 26L17 25ZM3 26L3 28L2 28L2 29L5 29L5 28L4 28L4 26ZM15 26L15 27L16 27L16 26ZM25 26L25 27L24 27L24 28L25 28L25 27L26 27L26 26ZM6 28L6 29L7 29L7 28ZM8 29L8 31L10 31L10 30L9 30L9 29ZM29 29L29 32L32 32L32 29ZM30 30L30 31L31 31L31 30ZM12 31L12 32L11 32L11 33L13 33L13 32L14 32L14 31ZM33 32L33 33L34 33L34 32ZM28 33L28 35L29 35L29 34L30 34L30 35L33 35L33 34L30 34L30 33ZM9 34L9 36L10 36L10 35L12 35L12 34ZM23 34L23 35L24 35L24 34ZM34 35L34 36L36 36L36 35ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM30 0L30 7L37 7L37 0ZM31 1L31 6L36 6L36 1ZM32 2L32 5L35 5L35 2ZM0 30L0 37L7 37L7 30ZM1 31L1 36L6 36L6 31ZM2 32L2 35L5 35L5 32Z" fill="#000000"/></g></g></svg>

                    `;

                        qrCodeCard.style.display = 'block';
                        qrCodeCard.style.boxShadow = '0px 0px 10px 0px rgba(0, 0, 0, 0.5)';
                        qrCodeCard.style.borderRadius = '16px';
                        qrCodeCard.style.padding = '30px';
                        $('#qrCodeImage').html('<img src="data:image/png;base64,' + response.qrCode + '">');
                    } else {
                        console.error('Failed to display QR code: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        }
    </script>
@endsection
