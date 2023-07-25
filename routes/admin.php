<?php

use App\Http\Controllers\Admin\AdminController;
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
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\TinTucController;
use App\Http\Controllers\Admin\PhieuNhapController;
use App\Http\Controllers\Admin\SendMailController;
use App\Http\Controllers\Admin\TaiKhoanController;
use App\Http\Controllers\Admin\ThongKeController;
use App\Models\Admin;

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

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout');
});
Route::get('/admin/login', [LoginController::class, 'admin_login']);
Route::post('/admin/login', [LoginController::class, 'Postlogin']);

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
//quản lý tài khoản
Route::resource('/taikhoan', TaiKhoanController::class);

//quản lý bình luận
Route::get('/binhluan', [BinhluanController::class, 'index']);
Route::POST('/binhluan', [BinhluanController::class, 'allow_comment']);

//quản lý tin tức
// Route::get('admin/qltintuc/view', [TinTucController::class, 'index']);
Route::resource('/tintuc', TinTucController::class);

//quản lý khuyến mãi

Route::resource('/khuyenmai', KhuyenMaiController::class);

//quản lý đơn hàng
// Route::get('admin/qldonhang/view', [DonHangController::class, 'index']);
Route::resource('/donhang', DonHangController::class);
Route::get('/chitiet/{MaDH}', [DonHangController::class, 'chitiet']);
Route::get('/update/{MaDH}', [DonHangController::class, 'updateStatus']);
//Quản lý phiếu nhập
// Route::get('admin/qlphieunhap/view', [PhieuNhapController::class, 'index']);
Route::resource('/phieunhap', PhieuNhapController::class);

//Quản lý chi tiết phiếu nhập
Route::get('admin/qlchitietphieunhap/view', function () {
    return view('admin/qlchitietphieunhap/view');
});
Route::resource('/chitiet', ChiTietPhieuNhapController::class);
//Thống kê đơn hàng
Route::get('admin/thongke/view', function () {
    return view('admin/thongke/view');
});
Route::resource('/thongke', ThongKeController::class);

//chỉnh sửa mật khẩu admin
Route::resource('/editpass', AdminController::class);
//GỬI ĐƠN HÀNG

Route::get('/textSend', [SendMailController::class, 'testSend'])->name('name');
Route::resource('/mail', SendMailController::class);