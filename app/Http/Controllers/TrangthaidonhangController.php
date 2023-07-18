<?php

namespace App\Http\Controllers;
use App\Models\Trangthaidonhang;
use Illuminate\Http\Request;

class TrangthaidonhangController extends Controller
{
    //
    public function index()
    {
        try {
            $statusAll = Trangthaidonhang::all();
            return json_decode($statusAll);
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}