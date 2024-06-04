<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'FrontEndController@index');
    Route::get('/category/dish/show/', 'FrontEndController@dish_show')->name('dish_show');

    Route::post('add/cart', 'cartController@insert')->name('add_to_cart');
    Route::get('cart/show', 'cartController@show')->name('cart_show');
    
    Route::get('/home', 'HomeController@index')->name('home.index');
    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        Route::get('/category/add','categoryController@index')->name('show_cate_table');
        Route::post('/category/save','categoryController@save')->name('cate_save');
        Route::get('/category/manage','categoryController@manage')->name('manage_cate');
        Route::get('/category/edit/{id}', 'categoryController@edit')->name('category.edit');
        Route::put('/category/update/{id}', 'categoryController@update')->name('category.update');
        Route::delete('/category/delete/{id}', 'categoryController@delete')->name('category.delete');
        Route::post('/category/change-status/{id}', 'categoryController@changeStatus')->name('category.changeStatus');

        Route::get('/delivery-boy/add','deliveryBoyController@index')->name('show_delivery_boy_table');
        Route::post('/delivery-boy/save','deliveryBoyController@save')->name('delivery_boy_save');
        Route::get('/delivery-boy/manage','deliveryBoyController@manage')->name('manage_delivery_boy');
        Route::get('/delivery-boy/edit/{id}', 'deliveryBoyController@edit')->name('delivery_boy.edit');
        Route::put('/delivery-boy/update/{id}', 'deliveryBoyController@update')->name('delivery_boy.update');
        Route::delete('/delivery-boy/delete/{id}', 'deliveryBoyController@delete')->name('delivery_boy.delete');
        Route::post('/delivery-boy/change-status/{id}', 'deliveryBoyController@changeStatus')->name('delivery_boy.changeStatus');
        
        Route::get('/coupon/add','couponController@index')->name('show_coupon_table');
        Route::post('/coupon/save','couponController@save')->name('coupon_save');
        Route::get('/coupony/manage','couponController@manage')->name('manage_coupon');
        Route::get('/coupon/edit/{id}', 'couponController@edit')->name('coupon.edit');
        Route::put('/coupon/update/{id}', 'couponController@update')->name('coupon.update');
        Route::delete('/coupon/delete/{id}', 'couponController@delete')->name('coupon.delete');
        Route::post('/coupon/change-status/{id}', 'couponController@changeStatus')->name('coupon.changeStatus');
        
        Route::get('/dish/add','dishController@index')->name('show_dish_table');
        Route::post('/dish/save','dishController@save')->name('dish_save');
        Route::get('/dish/manage', 'dishController@manage')->name('manage_dish');
        Route::get('/dish/edit/{id}', 'dishController@edit')->name('edit_dish');
        Route::put('/dish/update/{id}', 'dishController@update')->name('update_dish');
        Route::get('/dish/delete/{id}', 'dishController@delete')->name('delete_dish');
        Route::post('/dish/change-status/{id}', 'dishController@changeStatus')->name('change_dish_status');
    });
});