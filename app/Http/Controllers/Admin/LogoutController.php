<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function perform()
    {
        // dd(1);
        Auth::logout();
        return redirect('admin/login');
    }
}
