<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\TaiKhoan;
use Illuminate\Http\Request;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('admin');
    }
    public function index()
    {
        //
        $taikhoan = TaiKhoan::paginate(5);
        if($key = request()->key)
        {
            $taikhoan = TaiKhoan::where('MaKH','like',$key)->paginate(5);
        }
        return view('admin/qltaikhoan/view')->with(compact('taikhoan'));
        // return View('admin/qltaikhoan/view', ['taikhoan' => TaiKhoan::paginate(5)]);

    }

}
