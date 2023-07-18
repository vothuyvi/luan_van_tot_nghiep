<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\TaiKhoan;
use Illuminate\Http\Request;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return View('admin/qltaikhoan/view', ['taikhoan' => TaiKhoan::paginate(5)]);

    }

}