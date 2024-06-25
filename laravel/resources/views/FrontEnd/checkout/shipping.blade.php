@extends('FrontEnd.cart_master')

@section('title')
    Shipping information
@endsection

@section('content')
    <div class="login-page about">
        <img class="login-w3img" src="images/img3.jpg" alt="">
        <div class="container">
            <h3 class="w3ls-title w3ls-title1">Shipping method</h3>
            <div class="login-agileinfo">
                <form action="{{ route('store_shipping') }}" method="post">
                    @csrf
                    <input class="agile-ltext" type="text" name="name" placeholder="Username"
                        value="{{ $customer->name }}" required>
                    <input class="agile-ltext" type="email" name="email" placeholder="Your Email"
                        value="{{ $customer->email }}" required>
                    <input class="agile-ltext" type="text" name="phone" placeholder="Your Phone Number"
                        value="{{ $customer->phone }}" required>
                    <input class="agile-ltext" type="text" name="address" placeholder="Your address" required>
                    <div class="wthreelogin-text">
                        <ul>
                            <li>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>
                                    <span> I agree to the terms of service</span>
                                </label>
                            </li>
                        </ul>
                        <div class="clearfix"> </div>
                    </div>
                    <input type="submit" value="Next">
                </form>
            </div>
        </div>
    </div>
@endsection
