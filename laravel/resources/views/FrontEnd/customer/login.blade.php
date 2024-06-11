@extends('FrontEnd.cart_master')

@section('title')
    Login Customer
@endsection

@section('content')
    <div class="login-page about">
        <img class="login-w3img" src="images/img3.jpg" alt="">
        <div class="container">
            <h3 class="w3ls-title w3ls-title1">Login to your account</h3>
            <div class="login-agileinfo">
                <form method="POST" action="{{ route('sign_in_customer') }}">
                    @csrf
                    <input class="agile-ltext" type="email" name="email" placeholder="Email">
                    <input class="agile-ltext" type="password" name="password" placeholder="Password">
                    <div class="wthreelogin-text">
                        <ul>
                            <li>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>
                                    <span> Remember me ?</span>
                                </label>
                            </li>
                            <li><a href="#">Forgot password?</a> </li>
                        </ul>
                        <div class="clearfix"> </div>
                    </div>
                    <input type="submit" value="LOGIN">
                </form>
                <p>Don't have an Account? <a href="{{ route('sign_up') }}"> Sign Up Now!</a></p>
            </div>
        </div>
    </div>
@endsection