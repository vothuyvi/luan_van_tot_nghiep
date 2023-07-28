<?php

namespace App\Http\Controllers;
use App\Models\Loaisp;
use App\Models\Sanpham;
use Illuminate\Http\Request;

class LoaispController extends Controller
{
    function index()
    {
        try {
            $productTypeAll = Loaisp::all();
            return json_decode($productTypeAll);
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }

    function relatedProducts(Request $request)
    {
        try {
            $MaSP = $request->MaSP;
            $sanpham = Sanpham::where('MaSP', $MaSP)->first();
            $MaLoai = $sanpham->MaLoai;
            // dd($sanpham->MaLoai);
            $product = Loaisp::with(['sanpham'])
                ->where('MaLoai', $MaLoai)
                ->first();
            // dd($product);
            return json_decode($product);
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}