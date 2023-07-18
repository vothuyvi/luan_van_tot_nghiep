<?php

namespace App\Http\Controllers;
use App\Models\Khachhang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\ResponseApi;
use Illuminate\Support\Facades\Storage;
use File;

class KhachhangController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            //     // lấy record có username đ
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('MyApp')->accessToken;
                $data = ['users' => $user, 'token' => $token];
                $messge = 'Đăng nhập thành công';
                return ResponseApi::success($data, $messge);
            } else {
                $messge = 'Username or password wrong!';
                return ResponseApi::fails($messge, 401);
            }
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
    public function register(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8|max:16',
                'password_confirmation' => 'required|same:password',
            ]);
            $validator->after(function ($validator) use ($request) {
                $userItem = Khachhang::where('email', $request->email)->first();
                if ($userItem) {
                    $validator->errors()->add('email', 'This email has been used');
                }
            });

            if ($validator->fails()) {
                return ResponseApi::errors($validator->errors());
            } else {
                $user = new Khachhang();
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                $msg = 'Register success !';
                return ResponseApi::notifis($msg);
            }
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()
                ->token()
                ->delete();
            $message = 'success';
            return ResponseApi::notifis($message);
        }
    }

    public function getInfo(Request $request)
    {
        return ResponseApi::success(Auth()->User(), '');
    }

    public function updateProfile(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'address' => 'required|min:2|max:255',
                'phone' => 'required|numeric|digits_between:9,13',
                'hinhanh' => 'nullable|image|mimes:png,jpg,jpeg,bmp',
                'birthday' => 'nullable',
            ]);
            if ($validator->fails()) {
                return ResponseApi::errors($validator->errors());
            }
            $user = $request->user();
            if ($request->hasFile('hinhanh')) {
                if ($user->hinhanh) {
                    $oldPath = public_path() . 'images/uploads/' . $user->hinhanh;
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }
                $imageName = 'profile-image-' . time() . '.' . $request->hinhanh->extension();
                $request->hinhanh->move(public_path('/images/uploads/'), $imageName);
            } else {
                $imageName = $user->hinhanh;
            }
            $user->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'hinhanh' => $imageName,
                'birthday' => $request->birthday,
            ]);
            $msg = 'Register success !';
            return ResponseApi::success($user, $msg);
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}