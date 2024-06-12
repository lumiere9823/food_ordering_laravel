<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

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
        // Composer for 'FrontEnd.include.banner'
        View::composer('FrontEnd.include.banner', function ($view) {
            $categories = Category::where('category_status', 1)->get();
            $view->with(compact('categories'));
        });

        // Composer for 'FrontEnd.include.navTop'
        View::composer('FrontEnd.include.navTop', function ($view) {
            if (Auth::check()) {
                $orders = DB::table('orders')
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('payments', 'orders.order_id', '=', 'payments.order_id')
                    ->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
                    ->select(
                        'orders.*',
                        'users.name',
                        'payments.payment_type',
                        'payments.payment_status',
                        'shippings.*'
                    )
                    ->where('user_id', Auth::user()->id)
                    ->get();

                $order_details = DB::table('order_details')
                    ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
                    ->select(
                        'order_details.dish_name',
                        'order_details.dish_price',
                        'order_details.dish_qty'
                    )
                    ->where('user_id', Auth::user()->id)
                    ->get();

                $view->with(compact('orders', 'order_details'));
            } else {
                // Pass an empty array or default data when the user is not authenticated
                $view->with(['orders' => [], 'order_details' => []]);
            }
        });

        // Composer for 'FrontEnd.include.dish'
        View::composer('FrontEnd.include.dish', function ($view) {
            $categories = Category::where('category_status', 1)->get();
            $view->with(compact('categories'));
        });
    }
}