<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DonHang;
use App\Models\Khachhang;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{



    public function __construct(protected DonHang $email,) {

    }

    public function edit($id)
    {
        $mail= DonHang::find($id);
        return view('admin/Email/adminEmail',compact('mail'));
    }
    public function testSend(Request $request)
    {

        $a= DonHang::get();
        $a1= $request->input('email');
        dd($request->input('email'));

        Mail::send('admin/email/cusEmail',function($email) use($a) {
            $email->subject('THÔNG TIN ĐƠN HÀNG');
            $email->to($a);

        });


    // $mail = DonHang::find($request->input('email'));
    // $info = DonHang::all();
    // Mail::send('admin/Email/cusEmail',compact('info'),function($email) use($info) {
    //     $email->subject('THÔNG TIN ĐƠN HÀNG');
    //     $email->to('my2001.2906@gmail.com');

    // });

    }

}
