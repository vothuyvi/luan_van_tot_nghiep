<?php

namespace App\Http\Controllers;
use App\Models\Khachhang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\ResponseApi;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\Register;
use App\Mail\ResetPassword;

class KhachhangController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                if (empty($user->email_verified_at)) {
                    $messge = 'Tài khoản chưa được xác thực!';
                    return ResponseApi::fails($messge, 401);
                }
                $token = $user->createToken('MyApp')->accessToken;
                $data = ['users' => $user, 'token' => $token];
                $messge = 'Đăng nhập thành công';
                return ResponseApi::success($data, $messge);
            } else {
                $messge = 'Tên tài khoản hoặc mật khẩu chưa đúng!';
                return ResponseApi::fails($messge, 401);
            }
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
    public function register(Request $request)
    {
        try {
            $validator = \Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required|min:8|max:16',
                    'password_confirmation' => 'required|same:password',
                ],
                [
                    'email.required' => 'Email không được để trống.',
                    'email.email' => 'Email chưa đúng định dạng.',
                    'password.required' => 'Mật khẩu không được để trống.',
                    'password.min' => 'Mật khẩu chưa đủ độ dài 8 kí tự.',
                    'password.max' => 'Mật khẩu vượt quá độ dài cho phép.',
                    'password_confirmation.required' => 'Xác nhận mật khẩu',
                    'password_confirmation.same' => 'Xác nhận mật khẩu chưa phù hợp.',
                ],
            );
            $validator->after(function ($validator) use ($request) {
                $userItem = Khachhang::where('email', $request->email)->first();
                if ($userItem) {
                    $validator->errors()->add('email', 'Email đã tồn tại.');
                }
            });

            if ($validator->fails()) {
                return ResponseApi::errors($validator->errors());
            } else {
                $user = new Khachhang();
                $token = Str::random(40);
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->email_verify_token = $token;
                $user->save();
                $appURL = config('app.url');
                $mailData = [
                    'email' => $user->email,
                    'url' => $appURL . 'verify/' . $token,
                ];
                Mail::to($user->email)->send(new Register($mailData));
                $msg = 'Register success !';
                return ResponseApi::notifis($msg);
            }
        } catch (\Exception $e) {
            dd($e);
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
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:2|max:100',
                    'address' => 'required|max:255',
                    'phone' => 'required|numeric|digits_between:10,10',
                    'hinhanh' => 'nullable|image|mimes:png,jpg,jpeg,webp',
                ],
                [
                    'name.required' => 'Họ tên không được để trống.',
                    'name.min' => 'Họ tên chưa đủ độ dài cho phép.',
                    'name.max' => 'Họ tên vượt quá độ dài cho phép.',
                    'address.required' => 'Địa chỉ không được để trống.',
                    'address.max' => 'Địa chỉ vượt quá độ dài cho phép.',
                    'phone.digits_between' => 'Số điện thoại chưa đúng định dạng.',
                    'phone.required' => 'Số điện thoại không được để trống.',
                    'hinhanh.mimes' => 'Hình ảnh sai định dạng.',
                    'hinhanh.image' => 'Hình ảnh sai định dạng.',
                ],
            );
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

    public function verifyMail(Request $request)
    {
        try {
            $token = $request->token;
            $user = Khachhang::where('email_verify_token', $token)->first();
            if ($user) {
                if ($user->email_verified_at) {
                    return ResponseApi::fails('Cập nhật thất bại.');
                }
                $user->email_verified_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                $user->save();
                return ResponseApi::success($user, 'Cập nhật thành công');
            } else {
                return ResponseApi::fails('Cập nhật thất bại.');
            }
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $email = $request->email;
            $user = Khachhang::where('email', $email)->first();
            if (!$user) {
                $messge = 'Địa chỉ email chưa đúng!';
                return ResponseApi::fails($messge, 401);
            } else {
                $token = Str::random(40);
                $user->reset_password_token = $token;
                $user->reset_password_expired_at = dateAddMinute(30);
                $user->save();
                $appURL = config('app.url');
                $mailData = [
                    'email' => $user->email,
                    'url' => $appURL . 'reset-password/' . $token,
                ];
                Mail::to($user->email)->send(new ResetPassword($mailData));
                return ResponseApi::success($user, 'thành công');
            }
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
    public function resetPassword(Request $request)
    {
        try {
            $validator = \Validator::make(
                $request->all(),
                [
                    'token' => 'required',
                    'password' => 'required|min:8|max:16',
                    'password_confirmation' => 'required|same:password',
                ],
                [
                    'token.required' => 'Token không được để trống.',
                    'password.required' => 'Mật khẩu không được để trống.',
                    'password.min' => 'Mật khẩu chưa đủ độ dài 8 kí tự.',
                    'password.max' => 'Mật khẩu vượt quá độ dài cho phép.',
                    'password_confirmation.required' => 'Xác nhận mật khẩu',
                    'password_confirmation.same' => 'Xác nhận mật khẩu chưa phù hợp.',
                ],
            );
            $validator->after(function ($validator) use ($request) {
                $userItem = Khachhang::where('reset_password_token', $request->token)
                    ->where('reset_password_expired_at', '>=', dateNow())
                    ->first();
                if (!$userItem) {
                    $validator->errors()->add('token', 'Token không tồn tại hoặc đã hết hạn.');
                }
            });
            if ($validator->fails()) {
                return ResponseApi::errors($validator->errors());
            }
            $user = Khachhang::where('reset_password_token', $request->token)
                ->where('reset_password_expired_at', '>=', dateNow())
                ->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->reset_password_token = null;
                $user->reset_password_expired_at = null;
                $user->save();
                return ResponseApi::success($user, 'Cập nhật thành công');
            }
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}