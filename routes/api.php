<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\AnhController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('login', 'KhachhangController@login');
    Route::post('register', 'KhachhangController@register');
    Route::get('/product-new', 'SanphamController@new');
    Route::get('/product-best', 'SanphamController@best');
    Route::get('/product-all', 'SanphamController@index');
    Route::get('/product-type-all', 'LoaispController@index');
    Route::post('/product-related', 'LoaispController@relatedProducts');
    Route::get('/product-detail/{MaSP}', 'SanphamController@product');
    Route::post('/product-list', 'SanphamController@productList');
    Route::get('/news-detail', 'TintucController@newsDetail');
    Route::get('/news', 'TintucController@index');
    Route::post('/comments-list', 'BinhluanController@index');
    Route::get('/search/{TenSP}', 'SanphamController@searchName');
    Route::get('/sale', 'KhuyenmaiController@index');
    Route::post('/get-products', 'SanphamController@getProduct');
    Route::get('/test-send-mail', 'KhachhangController@testSendMail');
    Route::post('/verify-mail', 'KhachhangController@verifyMail');
    Route::post('/forgot-password', 'KhachhangController@forgotPassword');
    Route::post('/reset-password', 'KhachhangController@resetPassword');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', 'KhachhangController@logout');
        Route::get('/get-info', 'KhachhangController@getInfo');
        Route::post('/update-profile', 'KhachhangController@updateProfile');
        Route::post('/comments-store', 'BinhluanController@storeComment');
        Route::get('/status-all', 'TrangthaidonhangController@index');
        Route::get('/don-hang', 'DonhangController@index');

        Route::get('/phuong-thuc-thanh-toan', 'PhuongthucthanhtoanController@index');
        Route::post('/check-out', 'DonhangController@checkOut');
        Route::get('/khuyen-mai/{DieuKienApDung}', 'KhuyenmaiController@khuyenMai');
        Route::post('/payment', 'DonhangController@payment');
        Route::post('/payment-momo', 'DonhangController@paymentMoMo');
        Route::post('/update-order', 'DonhangController@updateOrder');
        Route::get('/order-detail', 'DonhangController@orderDetail');
    });
});