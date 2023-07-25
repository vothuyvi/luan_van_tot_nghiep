<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function admin_login()
    {
        return view('admin/login');
    }
    public function Postlogin( Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',

         ],[
            'email.required'=>'Không được bỏ trống',
            'password.required'=>'Không được bỏ trống',

        ]);
     $arr = ['email' => $request->email, 'password' => $request->password];
     if (Auth::guard('admin')->attempt($arr)) {
         //đăng nhập đúng
         return redirect('/index');
     } else {
         // dd('Đăng nhập thất bại');

         return redirect('admin/login')->with('error','email or password wrong');

         //đăng nhập sai
     }
    }

}
