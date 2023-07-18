<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    /*
     điều hướng các trang
     */
    public function index()
    {
        return view('index');
    }
}
