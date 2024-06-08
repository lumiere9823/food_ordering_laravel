@extends('FrontEnd.cart_master')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="products">
        <div class="container">
            <div class="col-md-9 product-w3ls-right"
                style="box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5); border-radius: 16px; padding:30px">
                <div class="card">
                    <div class="card-header text-muted">
                        <h4>Checkout</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Dear {{ Session::get('customer_name') }}</h3>
                                <h4 class="text-center" style="padding: 20px">We've to know which payment method you want.
                                </h4>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <h5 class="card-header mt-4 text-center text-muted">
                                Please select your payment method
                            </h5>
                            <div class="card-body">
                                <div class="checkout-left">
                                    <div class="address_form_agile mt-sm-5 mt-4">
                                        <form action="{{ route('new_order') }}" method="post">
                                            @csrf
                                            <table class="table">
                                                <tr>
                                                    <th>Cash On Delivery</th>
                                                    <td>
                                                        <input type="radio" name="payment_type" value="Cash" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Stripe Card</th>
                                                    <td>
                                                        <input type="radio" class="mr-5" name="payment_type"
                                                            value="Stripe">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
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
        </div>
    </div>
@endsection
