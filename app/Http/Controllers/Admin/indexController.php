<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class indexController extends Controller
{
    /*
     điều hướng các trang
     */
    public function index()
    {
        return redirect()->route('view1.index');

    }


}