<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\DonHang;
use App\Models\Admin\sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class indexController extends Controller
{
    /*
     điều hướng các trang
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        //
        $thang = now()->month;
        // dd($thang);
        $current = Carbon::now('Asia/Ho_Chi_Minh')
            ->startOfMonth()
            ->toDateString();
        $current1 = Carbon::now('Asia/Ho_Chi_Minh')
            ->endOfMonth()
            ->toDateString();
        $don = DonHang::whereBetween('NgayDat', [$current, $current1])->count('MaDH');
        // dd($don);
        $total = DonHang::whereBetween('NgayDat', [$current, $current1])->sum('TongTienDonHang');
        $data = sanpham::orderBy('SoLuong', 'DESC')->paginate(7);
        // đơn hàng hoàn thành
        $donhang = Donhang::where('MaTT', '=', '4')
            ->whereBetween('NgayDat', [$current, $current1])
            ->get();
        $doanhThuThucTe = 0;
        if ($donhang) {
            foreach ($donhang as $item) {
                $doanhThuThucTe += $item->TongTienDonHang;
            }
        }
        $doanhThuThucTe = number_format($doanhThuThucTe, 0, '', ',');
        // dd($tongtien);

        //TỔNG ĐƠN BỊ HUỶ
        $donhanghuy = Donhang::where('MaTT', '=', '5')
            ->whereBetween('NgayDat', [$current, $current1])
            ->count('MaDH');
        // dd($donhanghuy);
        return View('index')->with(compact('data', 'don', 'thang', 'total', 'doanhThuThucTe', 'donhanghuy'));
    }
}