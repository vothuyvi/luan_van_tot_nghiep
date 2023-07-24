<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Khuyenmai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
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
        $khuyenmai = Khuyenmai::orderBy('PhanTram','ASC')->paginate(3);

        if($key = request()->key)
        {
            $khuyenmai =  Khuyenmai::orderBy('PhanTram','ASC')->where('MaKM','like','%'.$key.'%')->paginate(3);
        }
        return View('admin/qlkhuyenmai/view')->with(compact('khuyenmai'));

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
            'TenKM'=>'required|',
            'DieuKienApDung'=>'required',
            'PhanTram'=>'required',
            'NgayBatDau'=>'required',
            'NgayKetThuc'=>'required|date|after:NgayBatDau',


         ],[
            'MaKM.required'=>'Không bỏ trống',
            'TenKM.required'=>'Không được bỏ trống',
            'DieuKienApDung.required'=>'Không được bỏ trống',
            'PhanTram.required'=>'Không bỏ trống',
            'NgayBatDau.required'=>'Không bỏ trống',
            'NgayKetThuc.required'=>'Không bỏ trống',
            'NgayKetThuc.after'=>'Ngày kết thúc phải sau ngày bắt đầu nhé!',
            'MaKM.unique'=>'Mã khuyến mãi không được trùng',

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
        $request->validate([
            'TenKM'=>'required',
            'DieuKienApDung'=>'required',
            'PhanTram'=>'required',
            'NgayBatDau'=>'required',
            'NgayKetThuc'=>'required|date|after:NgayBatDau',


         ],[
            'TenKM.required'=>'Không được bỏ trống',
            'PhanTram.required'=>'Không bỏ trống',
            'DieuKienApDung.required'=>'Không bỏ trống',
            'NgayBatDau.required'=>'Không bỏ trống',
            'NgayKetThuc.required'=>'Không bỏ trống',
            'NgayKetThuc.after'=>'Ngày kết thúc phải sau ngày bắt đầu nhé!',
            'MaKM.unique'=>'Mã khuyến mãi không được trùng',

        ]);

        $khuyenmai=Khuyenmai::find($id);
            $khuyenmai->TenKM=$request->input('TenKM');
            $khuyenmai->DieuKienApDung=$request->input('DieuKienApDung');
            $khuyenmai->PhanTram=$request->input('PhanTram');
            $khuyenmai->NgayKetThuc=$request->input('NgayKetThuc');
            $khuyenmai->NgayBatDau=$request->input('NgayBatDau');
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
