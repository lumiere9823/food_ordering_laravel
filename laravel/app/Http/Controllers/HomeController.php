<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        if(Auth::user()->role == 3){
            return redirect('/');
        }
        $today = Carbon::today();

        $yesterday = Carbon::yesterday();

        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        $totalOrders = Order::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])->count();
        $totalRevenue = Order::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])->sum('order_total');
        $totalProductSold = OrderDetail::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])->sum('dish_qty');

        $totalOrdersYesterday = Order::whereDate('created_at', $yesterday)->count();
        $totalRevenueYesterday = Order::whereDate('created_at', $yesterday)->sum('order_total');
        $totalProductSoldYesterday = OrderDetail::whereDate('created_at', $yesterday)->sum('dish_qty');

        $totalOrdersToday = Order::whereDate('created_at', $today)->count();
        $totalRevenueToday = Order::whereDate('created_at', $today)->sum('order_total');
        $totalProductSoldToday = OrderDetail::whereDate('created_at', $today)->sum('dish_qty');

        $data = [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalProductSold' => $totalProductSold,
            'totalOrdersYesterday' => $totalOrdersYesterday,
            'totalRevenueYesterday' => $totalRevenueYesterday,
            'totalProductSoldYesterday' => $totalProductSoldYesterday,
            'totalOrdersToday' => $totalOrdersToday,
            'totalRevenueToday' => $totalRevenueToday,
            'totalProductSoldToday' => $totalProductSoldToday,
        ];

        return view('BackEnd.Home.index', $data);
    }

}