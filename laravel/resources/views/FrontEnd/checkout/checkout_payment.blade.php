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
                                                        <input type="radio" name="payment_type" value="Cash" required>
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
    var qrCodeCard = $('#qrCodeContainer');
    
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
            console.log(response);
            if (response.success) {
                qrCodeCard.show();
                console.log(response.qrCode);
                qrCodeCard.html(`
                    <h5>QR Code for Online Payment</h5>
                    <p>Scan this QR code to proceed with the payment.</p>
                    <div id="qrCodeImage"><img src="data:image/svg+xml;base64,${response.qrCode}" alt="QR Code"></div>
                `);
                qrCodeCard.css({
                    display: 'block',
                    boxShadow: '0px 0px 10px 0px rgba(0, 0, 0, 0.5)',
                    borderRadius: '16px',
                    padding: '30px'
                });
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