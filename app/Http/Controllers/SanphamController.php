<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sanpham;
use App\Models\Chitietdonhang;
use Illuminate\Support\Facades\DB;
use App\Services\ResponseApi;

class SanphamController extends Controller
{
    //
    function new()
    {
        $productNews = Sanpham::with('anh')
            ->orderBy('NgayThem', 'desc')
            ->skip(0)
            ->take(5)
            ->get(); //limit 5
        return json_decode($productNews);
    }
    function best()
    {
        try {
            $productBests = Sanpham::with('anh')
                ->withSum('chitietdonhang', 'quantity')
                ->orderBy('chitietdonhang_sum_quantity', 'DESC')
                ->take(5)
                ->get();
            return ResponseApi::success($productBests, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }

    function index()
    {
        try {
            $productsAll = Sanpham::with('anh')
                ->orderBy('MaSP', 'desc')
                ->get();
            return json_decode($productsAll);
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }

    function product(Request $request)
    {
        try {
            $MaSP = $request->MaSP;
            $product = Sanpham::with('anh')
                ->where('MaSP', $MaSP)
                ->first();
            return json_decode($product);
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }

    public function productList(Request $request)
    {
        try {
            $MaLoai = $request->get('MaLoai');
            $TenSP = $request->get('TenSP');
            $MinPrice = $request->get('MinPrice', 0);
            $MaxPrice = $request->get('MaxPrice');
            $productList = Sanpham::query();
            if ($MaLoai) {
                $productList = $productList->where('MaLoai', $MaLoai);
            }
            if ($MinPrice != null) {
                $productList = $productList->where('GiaTien', '>=', $MinPrice);
            }
            if ($MaxPrice) {
                $productList = $productList->where('GiaTien', '<=', $MaxPrice);
            }
            if ($TenSP) {
                $productList = $productList->where('TenSP', 'like', '%' . $TenSP . '%');
            }
            $productList = $productList->orderBy('MaSP', 'desc')->paginate(9);
            return ResponseApi::success($productList, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
    public function getProduct(Request $request)
    {
        try {
            $listMaSP = $request->get('listMaSP', []);
            $product = Sanpham::whereIn('MaSP', $listMaSP)->get();
            return ResponseApi::success($product, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
    public function searchName(Request $request)
    {
        try {
            $TenSP = $request->TenSP;
            $product = Sanpham::where('TenSP', 'like', '%' . $TenSP . '%')->get();
            return ResponseApi::success($product, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}