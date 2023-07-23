<?php
use Illuminate\Support\Facades\Auth;

function adminUser()
{
    return Auth::guard('admin')->user();
}
function dateAddMinute($value, $format = 'Y-m-d H:i:s')
{
    return \Carbon\Carbon::now(env('TIMEZONE', 'Asia/Ho_Chi_Minh'))
        ->addMinutes($value)
        ->format($format);
}
function dateNow($format = 'Y-m-d H:i:s'): string
{
    return \Carbon\Carbon::now(env('TIMEZONE', 'Asia/Ho_Chi_Minh'))->format($format);
}
