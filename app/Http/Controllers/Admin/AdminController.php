<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\String\b;

class AdminController extends Controller
{

    public function edit(string $id)
    {
        //
        $pass = admin::find($id);
        return view('admin/qlmatkhau/edit', compact('pass'));
    }

    public function update(Request $request, string $id)
    {
        //
        //  dd(request()->all());
        $request->validate(
            [
                'password' => 'required',
                'password_comfirm' => 'required|same:password',

            ],
            [
                'password.required' => 'Không được bỏ trống.',
                'password_comfirm.required' => 'Không được bỏ trống.',
                'password_comfirm.same'=>'Mật khẩu xác nhận không đúng',

            ],
        );
     $pass = admin::find($id);
     $pass->password = bcrypt($request->input('password'));
     $pass->update();
     return redirect()
         ->route('sanpham.index')
         ->with('success', 'Đổi Password thành công');

    }

}
