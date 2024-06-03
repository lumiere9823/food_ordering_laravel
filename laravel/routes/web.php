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
    Route::get('/', 'HomeController@index')->name('home.index');

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
        Route::get('/category/edit/{id}', [categoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/delete/{id}', [categoryController::class, 'delete'])->name('category.delete');
        Route::post('/category/change-status/{id}', [categoryController::class, 'changeStatus'])->name('category.changeStatus');
    });
});