<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anh;

class AnhController extends Controller
{
    //
    public function index(Request $request) {
        $MaSP = $request->MaSP;
        $new = Anh::with(['sanpham'])->where('MaSP', $MaSP )->get();
        return json_decode($new);
    }
}