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
        $thang= now()->month;
        // dd($thang);
        $current = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $current1 = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->toDateString();
        $don=DonHang::whereBetween('NgayDat', [$current,$current1])->count('MaDH');
        // dd($don);
        $total=DonHang::whereBetween('NgayDat', [$current,$current1])->sum('TongTienDonHang');
        $data = sanpham::orderBy('SoLuong','DESC')->paginate(7);
        return view('index')->with(compact('data','don','thang','total'));
    }
}
