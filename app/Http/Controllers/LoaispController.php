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

    function product(Request $request)
    {
        try {
            $MaLoai = $request->MaLoai;
            $product = Loaisp::with(['sanpham'])
                ->where('MaLoai', $MaLoai)
                ->first();
            return json_decode($product);
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}