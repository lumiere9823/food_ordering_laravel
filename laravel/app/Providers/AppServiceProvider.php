<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
        View::composer('FrontEnd.include.dish', function ($view) {
            $categories = Category::where('category_status', 1)->get();
            $view->with(compact('categories'));
        });
    }
}