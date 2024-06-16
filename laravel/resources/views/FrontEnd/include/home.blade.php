@extends('FrontEnd.master')
@section('title')
    Home
@endsection
@section('content')
    <div class="banner">
        <div class="banner-text">
            <div class="container">
                <h2>Delicious food from the <br> <span>Best Chefs For you.</span></h2>
                <div class="agileits_search">
                    <form action="#" method="post">
                        <input name="Search" type="text" placeholder="Enter Your Area Name" required="">
                        <select id="agileinfo_search" name="agileinfo_search" required="">
                            <option value="">Popular Cities</option>
                            <option value="navs">New York</option>
                            <option value="quotes">Los Angeles</option>
                            <option value="videos">Chicago</option>
                            <option value="news">Phoenix</option>
                            <option value="notices">Fort Worth</option>
                            <option value="all">Other</option>
                        </select>
                        <input type="submit" value="Search">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="add-products">
        <div class="container">
            <div class="add-products-row">
                <div class="w3ls-add-grids">
                    <a href="menu.html">
                        <h4>Get <span>20%<br>Cashback</span></h4>
                        <h5>Ordered in mobile app only </h5>
                        <h6>Order Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>
                    </a>
                </div>
                <div class="w3ls-add-grids w3ls-add-grids-right">
                    <a href="menu.html">
                        <h4>GET Upto<span><br>40% Offer</span></h4>
                        <h5>Sunday special discount</h5>
                        <h6>Order Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>
                    </a>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <div class="wthree-order">
        <img src="{{ asset('/deli.png') }}" style="position: absolute;width: 15%;left: 4%;" class="" alt="" />
        <div class="container">
            <h3 class="w3ls-title">How To Order Product</h3>
            <p class="w3lsorder-text">Get your favourite product in 4 simple steps.</p>
            <div class="order-agileinfo">
                <div class="col-md-3 col-sm-3 col-xs-6 order-w3lsgrids">
                    <div class="order-w3text">
                        <i class="fa fa-solid fa-cube" aria-hidden="true"></i>
                        <h5>Choose Product</h5>
                        <span>1</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 order-w3lsgrids">
                    <div class="order-w3text">
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                        <h5>Pay Money</h5>
                        <span>2</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 order-w3lsgrids">
                    <div class="order-w3text">
                        <i class="fa fa-truck" style="" aria-hidden="true"></i>
                        <h5>shipping</h5>
                        <span>3</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 order-w3lsgrids">
                    <div class="order-w3text">
                        <i class="fa fa-solid fa-box" aria-hidden="true"></i>
                        <h5>Handed Order</h5>
                        <span>4</span>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //order -->
    <!-- deals -->
    <div class="w3agile-deals">
        <div class="container">
            <h3 class="w3ls-title">Special Services</h3>
            <div class="dealsrow">
                <div class="col-md-6 col-sm-6 deals-grids">
                    <div class="deals-left">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                    </div>
                    <div class="deals-right">
                        <h4>FREE DELIVERY</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tempus justo ac </p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-6 col-sm-6 deals-grids">
                    <div class="deals-left">
                        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                    </div>
                    <div class="deals-right">
                        <h4>Party Orders</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tempus justo ac </p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-6 col-sm-6 deals-grids">
                    <div class="deals-left">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="deals-right">
                        <h4>Team up Scheme</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tempus justo ac </p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-6 col-sm-6 deals-grids">
                    <div class="deals-left">
                        <i class="fa fa-building" aria-hidden="true"></i>
                    </div>
                    <div class="deals-right">
                        <h4>corporate orders</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tempus justo ac </p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //deals -->
    <!-- dishes -->
    <div class="w3agile-spldishes">
        <div class="container">
            <h3 class="w3ls-title">Special Foods</h3>
            <div class="spldishes-agileinfo">
                <div class="col-md-3 spldishes-w3left" style="height: 200px">
                    <h5 class="w3ltitle">Staple Specials</h5>
                    <p>Vero vulputate enim non justo posuere placerat Phasellus mauris vulputate enim non justo enim .
                    </p>
                </div>
                <div class="col-md-9 spldishes-grids">
                    <!-- Owl-Carousel -->
                    <div id="owl-demo" class="owl-carousel text-center agileinfo-gallery-row">
                        @foreach ($dishes as $dish)
                            <a href="{{ route('dish_show', ['category_id' => $dish->category_id]) }}" class="item g1"
                                style="height: 200px; width: 200px; display: inline-block; text-align: center; position: relative;">
                                <img class="lazyOwl" style="height: 200px; width: 200px;"
                                    src="{{ asset('dish_images/' . $dish->dish_image) }}" title="Our latest gallery"
                                    alt="" />

                                @if ($dish->number_of_products == 0)
                                    <img class="sold-out-img"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 50px; width: 150px;"
                                        src="{{ asset('sold-out-png-19953.png') }}" title="Sold Out" alt="Sold Out" />
                                @endif

                                <div class="agile-dish-caption">
                                    <h4>{{ $dish->dish_name }}</h4>
                                    <span>{{ $dish->dish_detail }}</span>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection
