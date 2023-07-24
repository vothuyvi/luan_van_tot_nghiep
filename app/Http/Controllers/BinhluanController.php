<?php

namespace App\Http\Controllers;
use App\Models\Binhluan;
use App\Models\Khachhang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ResponseApi;

class BinhluanController extends Controller
{
    //

    public function index(Request $request)
    {
        $MaSP = $request->MaSP;
        $cmts = Binhluan::with('khachhang')
            ->where('MaSP', $MaSP)
            ->where('TrangThai', '=', 0)
            ->orderBy('MaBL', 'desc')
            ->get();

        return ResponseApi::success($cmts, '');
    }

    public function storeComment(Request $request)
    {
        try {
            $user = Auth::user();
            $binhluan = new Binhluan();
            $binhluan->MaKH = $user->MaKH;
            $binhluan->MaSP = $request->MaSP;
            $binhluan->NoiDung = $request->NoiDung;
            $binhluan->NgayBinhLuan = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $binhluan->save();
            return ResponseApi::success($binhluan, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}
