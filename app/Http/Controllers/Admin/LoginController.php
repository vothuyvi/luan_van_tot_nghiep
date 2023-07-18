<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin/login');
    }
    //    public function Postlogin( Request $request)
    //    {
    //     $arr=
    //     ['email' => $request ->email,
    //      'password' => $request->password];
    //     if (Auth::attempt($arr)){
    //         //đăng nhập đúng
    //         Redirect::to('/');
    //     }else
    //     {
    //         dd('Đăng nhập thất bại');
    //         //đăng nhập sai
    //     }
    //    }
    public function store(Request $request)
    {
        $arr = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($arr)) {
            //đăng nhập đúng
            return view('index');
        } else {
            // dd('Đăng nhập thất bại');
            return view('admin/login');

            //đăng nhập sai
        }
    }
}