<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DonHang;
use App\Models\Admin\sanpham;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $thang= now()->month;
        // dd($thang);
        $current = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $current1 = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->toDateString();
        $don=DonHang::whereBetween('NgayDat', [$current,$current1])->count('MaDH');
        // dd($don);
        $total=DonHang::whereBetween('NgayDat', [$current,$current1])->sum('TongTienDonHang');
        $data = sanpham::orderBy('SoLuong','DESC')->paginate(7);

        return View('admin/thongke/view')->with(compact('data','don','thang','total'));
    }

}
