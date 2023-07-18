<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Models\Phuongthucthanhtoan;
use Illuminate\Http\Request;
use App\Services\ResponseApi;

class PhuongthucthanhtoanController extends Controller
{
    //
    public function index()
    {
        try {
            $phuongthucthanhtoan = Phuongthucthanhtoan::all();
            return ResponseApi::success($phuongthucthanhtoan, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}
