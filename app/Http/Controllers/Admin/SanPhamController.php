<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Khuyenmai;
use App\Models\Admin\loai;
use App\Models\Admin\sanpham;
use App\Http\Requests\ProductInsert;
use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validator;
use Illuminate\Http\RedirectResponse;
use App\Services\ResponseApi;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = sanpham::with('loai')->paginate(5);
        return View('admin/qlsanpham/view1')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $a=['loai'=>loai::all()];
        // $b=['khuyenmai'=>Khuyenmai::all()];
        return View('admin/qlsanpham/insert', ['loai' => loai::all(), 'khuyenmai' => Khuyenmai::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'MaSP' => 'required|unique:sanpham',
                'TenSP' => 'required',
                'NgayThem' => 'required',
                'MoTa' => 'required',
                'GiaTien' => 'required',
                'KichThuoc' => 'required',
                'upload_file' => 'required|image|mimes:png,jpg,jpeg,bmp',
                'MaLoai' => 'required',
            ],
            [
                'MaSP.required' => 'Không được bỏ trống',
                'TenSP.required' => 'Không được bỏ trống',
                'NgayThem.required' => 'Không được bỏ trống',
                'MoTa.required' => 'Không được bỏ trống',
                'GiaTien.required' => 'Không được bỏ trống',
                'KichThuoc.required' => 'Không được bỏ trống',
                'upload_file.required' => 'sai định dạng ảnh',
                'MaLoai.required' => 'Không được bỏ trống',
            ],
        );
        if ($request->hasFile('upload_file')) {
            $file = $request->upload_file;

            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            $file->move(public_path('images/products/'), $file_name);
            $request->merge(['HinhAnh' => $file_name]);
        }
        // dd($request->all());
        sanpham::create($request->all());
        return redirect()
            ->route('sanpham.index')
            ->with('success', 'Thêm thành công');
    }
    //edit
    public function edit(string $id)
    {
        //
        $sanpham = sanpham::find($id);
        return view('admin/qlsanpham/edit', compact('sanpham'), ['loai' => loai::all(), 'khuyenmai' => Khuyenmai::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $sanpham = sanpham::find($id);
        $sanpham->TenSP = $request->input('TenSP');
        // $sanpham->SoLuong = $request->input('SoLuong');
        $sanpham->MoTa = $request->input('MoTa');
        $sanpham->GiaTien = $request->input('GiaTien');
        $sanpham->KichThuoc = $request->input('KichThuoc');
        $sanpham->MaLoai = $request->input('MaLoai');
        $sanpham->MaKM = $request->input('MaKM');
        $sanpham->update();
        return redirect()
            ->route('sanpham.index')
            ->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sanpham $sanpham)
    {
        //
        $sanpham->delete();
        return redirect()
            ->route('sanpham.index')
            ->with('success', 'Xóa thành công');
    }
}