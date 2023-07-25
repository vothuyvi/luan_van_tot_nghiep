<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\PhieuNhap;
use App\Models\Admin\ChiTietPhieuNhap;
use Illuminate\Http\Request;

class PhieuNhapController extends Controller
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
        $phieunhap = PhieuNhap::paginate(5);
        $chitiet=ChiTietPhieuNhap::paginate(5);
        if($key = request()->key)
        {
            $phieunhap = PhieuNhap::where('MaPN','like',$key)->paginate(5);
        }
        return View('admin/qlphieunhap/view')->with(compact('phieunhap','chitiet'));
        // return View('admin/qlphieunhap/view', ['phieunhap' => PhieuNhap::paginate(5), 'chitiet' => ChiTietPhieuNhap::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View('admin/qlphieunhap/insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'MaPN' => 'required|unique:phieunhap',
                'NgayNhap' => 'required',
            ],
            [
                'MaPN.required' => 'Không được bỏ trống',
                'MaPN.unique' => 'Mã tồn tại',

                'NgayNhap.required' => 'Không được bỏ trống',
            ],
        );
        PhieuNhap::create($request->all());
        return redirect()
            ->route('phieunhap.index')
            ->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,Request $request)
    {
        //

        $phieunhap = PhieuNhap::find($id);
        return view('admin/qlphieunhap/edit', compact('phieunhap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //
        $request->validate(
            [
                'NgayNhap' => 'required',
            ],
            [
                'NgayNhap.required' => 'Không được bỏ trống',
            ],
        );
        $phieunhap = PhieuNhap::find($id);
        $phieunhap->NgayNhap = $request->input('NgayNhap');
        $phieunhap->update();
        return redirect()
            ->route('phieunhap.index')
            ->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
