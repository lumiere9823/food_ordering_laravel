@extends('layouts.app-master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div style="min-height:150px">
            <h1>
                Admin Dashboard
                <small>Optional description</small>
            </h1>
        </div>
        <div class="followers">
            <div class="followers-card">
                <div class="followers-card_border facebook"></div>
                <div class="followers-number">
                    <span class="followers-number_value">{{$totalOrders}}</span>
                    <p class="followers-number_text">Orders This Month</p>
                </div>
                @if($totalOrdersToday >= $totalOrdersYesterday )
                <div class="fallowers-today-number positive">
                    <img src="https://raw.githubusercontent.com/davidsonaguiar/frontendmentor/main/Social%20media%20dashboard/images/icon-up.svg"
                        alt="">
                    <span class="followers-today-number_text">{{$totalOrdersToday}} Today</span>
                </div>
                @else
                <div class="fallowers-today-number negative">
                    <img src="https://raw.githubusercontent.com/davidsonaguiar/frontendmentor/main/Social%20media%20dashboard/images/icon-down.svg" alt="">
                    <span class="followers-today-number_text">{{$totalOrdersToday}} Today</span>
                </div>
                @endif

            </div>
            
            <div class="followers-card">
                <div class="followers-card_border facebook"></div>
                <div class="followers-number">
                    <span class="followers-number_value">{{$totalRevenue}}</span>
                    <p class="followers-number_text">Revenue This Month</p>
                </div>
                @if($totalRevenueToday >= $totalRevenueYesterday )
                <div class="fallowers-today-number positive">
                    <img src="https://raw.githubusercontent.com/davidsonaguiar/frontendmentor/main/Social%20media%20dashboard/images/icon-up.svg"
                        alt="">
                    <span class="followers-today-number_text">{{$totalRevenueToday}} Today</span>
                </div>
                @else
                <div class="fallowers-today-number negative">
                    <img src="https://raw.githubusercontent.com/davidsonaguiar/frontendmentor/main/Social%20media%20dashboard/images/icon-down.svg" alt="">
                    <span class="followers-today-number_text">{{$totalRevenueToday}} Today</span>
                </div>
                @endif
            </div>
            
            <div class="followers-card">
                <div class="followers-card_border facebook"></div>
                <div class="followers-number">
                    <span class="followers-number_value">{{$totalProductSold}}</span>
                    <p class="followers-number_text">Products Sold This Month</p>
                </div>
                @if($totalProductSoldToday >= $totalProductSoldYesterday )
                <div class="fallowers-today-number positive">
                    <img src="https://raw.githubusercontent.com/davidsonaguiar/frontendmentor/main/Social%20media%20dashboard/images/icon-up.svg"
                        alt="">
                    <span class="followers-today-number_text">{{$totalProductSoldToday}} Today</span>
                </div>
                @else
                <div class="fallowers-today-number negative">
                    <img src="https://raw.githubusercontent.com/davidsonaguiar/frontendmentor/main/Social%20media%20dashboard/images/icon-down.svg" alt="">
                    <span class="followers-today-number_text">{{$totalProductSoldToday}} Today</span>
                </div>
                @endif
            </div>
            <div class="followers-card">
                <div class="followers-card_border facebook"></div>
                <div class="followers-number">
                    <span class="followers-number_value">1987</span>
                    <p class="followers-number_text">Followers</p>
                </div>
                <div class="fallowers-today-number positive">
                    <img src="https://raw.githubusercontent.com/davidsonaguiar/frontendmentor/main/Social%20media%20dashboard/images/icon-up.svg"
                        alt="">
                    <span class="followers-today-number_text">12 Today</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    </section>
</div>
@endsection