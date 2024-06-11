<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use DB;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('FrontEnd.include.banner', function ($view) {
            $categories = Category::where('category_status', 1)->get();
            $view->with(compact('categories'));
        });
        View::composer('FrontEnd.include.navTop', function ($view) {
            $orders = DB::table('orders')
              ->join('customers', 'orders.customer_id', '=', 'customers.id')
              ->join('payments', 'orders.order_id', '=', 'payments.order_id')
              ->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
              ->select(
                  'orders.*',
                  'customers.name',
                  'payments.payment_type',
                  'payments.payment_status',
                  'shippings.*',
              )
              ->where('customer_id', Session::get('customer_id'))
              ->get();  

              $order_details = DB::table('order_details')    
              ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
              ->select(
                  'order_details.dish_name',
                  'order_details.dish_price',
                  'order_details.dish_qty'
              )
              ->where('customer_id', Session::get('customer_id'))
              ->get();      
            $view->with(compact('orders','order_details'));
        });
        View::composer('FrontEnd.include.dish', function ($view) {
            $categories = Category::where('category_status', 1)->get();
            $view->with(compact('categories'));
        });
    }
}