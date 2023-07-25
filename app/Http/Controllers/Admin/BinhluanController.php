<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Binhluan;
use Illuminate\Http\Request;

class BinhluanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('admin');
    }
    public function index()
    {
        //
        $binhluan = Binhluan::with('products')->paginate(8);
        if($key = request()->key)
        {
            $binhluan = Binhluan::where('MaSP','like','%'.$key.'%')->paginate(8);
        }
        // $binhluan = Binhluan::with('products')->paginate(8);
        return View('admin/qlbinhluan/view')->with(compact('binhluan'));
        // return View('admin/qlbinhluan/view', ['data' => Binhluan::with('products')->orderBy('MaBL', 'ASC')]);
    }

    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $binhluan = Binhluan::find($data['comment_MaBL']);
        $binhluan->Status = $data['comment_status'];
        $binhluan->save();

    }


}
