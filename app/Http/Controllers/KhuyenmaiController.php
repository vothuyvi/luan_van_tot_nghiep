<?php

namespace App\Http\Controllers;
use App\Models\Khuyenmai;
use Illuminate\Http\Request;
use App\Services\ResponseApi;

class KhuyenmaiController extends Controller
{
    //
    public function index()
    {
        try {
            $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            // dd($now);
            $khuyenMai = Khuyenmai::whereRaw(
                "DATE_FORMAT(NgayBatDau, '%Y-%m-%d') <= '$now' AND DATE_FORMAT(NgayKetThuc, '%Y-%m-%d') >= '$now'",
            )->get();
            return ResponseApi::success($khuyenMai, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
    public function khuyenMai(Request $request)
    {
        $dieuKien = $request->DieuKienApDung;
        $sale = KhuyenMai::where('DieuKienApDung', '<=', $dieuKien)->get();
        return ResponseApi::success($sale, '');
    }
}