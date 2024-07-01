<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   

    Route::get('/', 'FrontEndController@index');
    Route::get('/category/dish/show/', 'FrontEndController@dish_show')->name('dish_show');

    Route::post('add/cart', 'CartController@insert')->name('add_to_cart');
    Route::get('add/remove', 'CartController@remove')->name('remove-item');
    Route::get('cart/show', 'CartController@show')->name('cart_show');
    Route::post('/update-quantity', 'CartController@updateQuantity')->name('update-quantity');
    Route::post('/search', 'FrontEndController@search')->name('search');
    Route::get('/home', 'HomeController@index')->name('home.index');
    Route::group(['middleware' => ['guest']], function() {

        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        
    });
    
    Route::get('/auth/google', 'App\Http\Controllers\GoogleAuthController@redirectToGoogle')->name('google-auth');
    Route::get('/auth/google/callback', 'App\Http\Controllers\GoogleAuthController@handleGoogleCallback');
    
    Route::group(['middleware' => ['auth']], function() {

        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        Route::get('/category/add','CategoryController@index')->name('show_cate_table');
        Route::post('/category/save','CategoryController@save')->name('cate_save');
        Route::get('/category/manage','CategoryController@manage')->name('manage_cate');
        Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::put('/category/update/{id}', 'CategoryController@update')->name('category.update');
        Route::delete('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');
        Route::post('/category/change-status/{id}', 'CategoryController@changeStatus')->name('category.changeStatus');
        
        Route::get('/coupon/add','CouponController@index')->name('show_coupon_table');
        Route::post('/coupon/save','CouponController@save')->name('coupon_save');
        Route::get('/coupon/manage','CouponController@manage')->name('manage_coupon');
        Route::get('/coupon/edit/{id}', 'CouponController@edit')->name('coupon.edit');
        Route::put('/coupon/update/{id}', 'CouponController@update')->name('coupon.update');
        Route::delete('/coupon/delete/{id}', 'CouponController@delete')->name('coupon.delete');
        Route::post('/coupon/change-status/{id}', 'CouponController@changeStatus')->name('coupon.changeStatus');
        
        Route::get('/dish/add','DishController@index')->name('show_dish_table');
        Route::post('/dish/save','DishController@save')->name('dish_save');
        Route::get('/dish/manage', 'DishController@manage')->name('manage_dish');
        Route::get('/dish/edit/{id}', 'DishController@edit')->name('edit_dish');
        Route::put('/dish/update/{id}', 'DishController@update')->name('update_dish');
        Route::delete('/dish/delete/{id}', 'DishController@delete')->name('delete_dish');
        Route::post('/dish/change-status/{id}', 'DishController@changeStatus')->name('change_dish_status');


        Route::get('/role/add','RoleController@show')->name('show_role_table');
        Route::post('/role/save','RoleController@store')->name('role_save');
        Route::get('/role/manage','RoleController@manage')->name('role_manage');
        Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::put('/role/update/{id}', 'RoleController@update')->name('role.update');
        Route::delete('/role/delete/{id}', 'RoleController@delete')->name('role.delete');

        Route::get('/checkout/payment','CheckOutController@payment')->name('checkout_payment');
        Route::post('/checkout/new/order','CheckOutController@order')->name('new_order');
        Route::get('/checkout/order/complete','CheckOutController@order_complete')->name('order_complete');

        Route::get('/order/manage','OrderController@manageOrderAdmin')->name('order_manage');
        Route::get('/order/manage-shipper','OrderController@manageOrderShipper')->name('order_manage_shipper');
        Route::get('/order/manage-self-shipper','OrderController@manageOrderSelfShipper')->name('order_manage_self_shipper');
        Route::delete('/order/delete/{order_id}','OrderController@deleteOrder')->name('delete_order');
        Route::put('/order/update-status/{id}', 'OrderController@updateStatus')->name('update_status');
        Route::put('/order/accepted_order/{id}', 'OrderController@acceptOrder')->name('accepted_order');

        Route::post('/coupon/apply','UserController@couponApply')->name('apply_coupon');
        
        Route::get('/user/add','UserController@save')->name('show_user_table');
        Route::post('/user/save','UserController@store')->name('user_save');
        Route::get('/user/manage','UserController@manage')->name('manage_user');
        Route::get('/user/manage-shipper','UserController@manageShipper')->name('manage_shipper');
        Route::get('/users/search', 'UserController@search')->name('users.search');
        Route::get('/shippers/search', 'UserController@searchShipper')->name('shippers.search');
        Route::put('/user/update/{id}', 'UserController@update')->name('user.update');
        Route::delete('/user/delete/{id}', 'UserController@delete')->name('user.delete');
        Route::get('/shipping','UserController@shipping')->name('shipping.show');
        Route::post('/shipping/store','UserController@store_shipping')->name('store_shipping');

        Route::post('/generate-qr', 'TransactionController@generateQR')->name('generate_qr');
        Route::post('/display-qr', 'TransactionController@displayQR')->name('display_qr');

    });
});