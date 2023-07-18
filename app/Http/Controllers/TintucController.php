<?php

namespace App\Http\Controllers;
use App\Models\Tintuc;
use Illuminate\Http\Request;
use App\Services\ResponseApi;
class TintucController extends Controller
{
    //
    public function index()
    {
        try {
            $listNews = Tintuc::all();
            return ResponseApi::success($listNews, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
    public function newsDetail(Request $request)
    {
        try {
            $MaTT = $request->MaTT;
            $tintuc = Tintuc::where('MaTT', $MaTT)->first();
            return ResponseApi::success($tintuc, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}