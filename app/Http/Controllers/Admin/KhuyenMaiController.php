<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Khuyenmai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return View('admin/qlkhuyenmai/view',['khuyenmai'=>Khuyenmai::paginate(5)]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View('admin/qlkhuyenmai/insert');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'MaKM'=>'required|unique:khuyenmai',
            'TenKM'=>'required|unique:khuyenmai',
            'PhanTram'=>'required',
            'NgayBatDau'=>'required',
            'NgayKetThuc'=>'required',
            'TrangThai'=>'required',


         ],[
            'MaKM.required'=>'Không bỏ trống',
            'TenKM.required'=>'Không được bỏ trống',
            'PhanTram.required'=>'Không bỏ trống',
            'NgayBatDau.required'=>'Không bỏ trống',
            'NgayKetThuc.required'=>'Không bỏ trống',
            'TrangThai.required'=>'Không bỏ trống',
            'MaKM.unique'=>'Mã khuyến mãi không được trùng',
            'TenKM.unique'=>'Tên loại sản phẩm đã có',

        ]);
        Khuyenmai::create($request->all());
        return redirect()->route('khuyenmai.index')->with('success','Thêm thành công');
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
    public function edit(string $id)
    {
        //
        $khuyenmai=Khuyenmai::find($id);
        return view('admin/qlkhuyenmai/edit',compact('khuyenmai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $khuyenmai=Khuyenmai::find($id);
        $khuyenmai->TenKM=$request->input('TenKM');
        $khuyenmai->PhanTram=$request->input('PhanTram');
        $khuyenmai->NgayKetThuc=$request->input('NgayKetThuc');
        $khuyenmai->NgayBatDau=$request->input('NgayBatDau');
        $khuyenmai->TrangThai=$request->input('TrangThai');

        $khuyenmai->update();
        return redirect()->route('khuyenmai.index')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Khuyenmai $khuyenmai)
    {
        //
        $khuyenmai->delete();
        return redirect()->route('khuyenmai.index')->with('success','Xóa thành công');
    }
}