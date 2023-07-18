<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\indexController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BinhluanController;
use App\Http\Controllers\Admin\ChiTietPhieuNhapController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\HinhAnhController;
use App\Http\Controllers\Admin\KhuyenMaiController;
use App\Http\Controllers\Admin\LoaiController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\TinTucController;
use App\Http\Controllers\Admin\PhieuNhapController;
use App\Http\Controllers\Admin\TaiKhoanController;

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
// Route::get('/admin/test', [TestController::class, 'index']);

Route::get('/admin/login', function () {
    return view('admin/login');
});
Route::resource('admin/login', LoginController::class);
//
Route::group(['middleware' => 'guest'], function () {});
Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Route
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
});

// Route::post('login','LoginController@Postlogin');
// Route::group(['middleware'=>'guest'],function(){
//     Route::match(['get','post'],'login',['as'=>'/','admin'=>'LoginController']);
// });

//Trang chủ
Route::get('/index', [indexController::class, 'index']);
//quản lý sản phẩm
Route::get('admin/qlsanpham/view1', function () {
    return view('admin/qlsanpham/view1');
});
//sử dụng sanphamcontroller để thêm xóa, sửa.
Route::resource('/sanpham', SanPhamController::class);
//quản lý hình ảnh
Route::get('admin/qlhinhanh/view', function () {
    return view('admin/qlhinhanh/view');
});
Route::resource('/hinhanh', HinhAnhController::class);

//quản lý loại sản phẩm
Route::get('admin/qlloai/view', [LoaiController::class, 'index']);
Route::resource('/loai', LoaiController::class);

Route::get('admin/qltaikhoan/view', function () {
    return view('admin/qltaikhoan/view');
});
Route::resource('/taikhoan', TaiKhoanController::class);

Route::get('admin/qlbinhluan/view', [BinhluanController::class, 'index']);
Route::POST('/allow_comment', 'BinhluanController@allow_comment');
//quản lý tin tức
Route::get('admin/qltintuc/view', [TinTucController::class, 'index']);

Route::resource('/tintuc', TinTucController::class);

//quản lý khuyến mãi

Route::resource('/khuyenmai', KhuyenMaiController::class);

//quản lý đơn hàng
Route::get('admin/qldonhang/view', [DonHangController::class, 'index']);
Route::resource('/donhang', DonHangController::class);

//Quản lý phiếu nhập
Route::get('admin/qlphieunhap/view', [PhieuNhapController::class, 'index']);
Route::resource('/phieunhap', PhieuNhapController::class);

//Quản lý chi tiết phiếu nhập
Route::get('admin/qlchitietphieunhap/view', function () {
    return view('admin/qlchitietphieunhap/view');
});
Route::resource('/chitiet', ChiTietPhieuNhapController::class);

Route::get('admin/thongke/view', function () {
    return view('admin/thongke/view');
});
