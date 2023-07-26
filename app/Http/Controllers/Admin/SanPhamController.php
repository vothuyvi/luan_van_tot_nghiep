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
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        // dd(adminUser()->email);
        // dd(request()->key);
        $data = sanpham::with('loai')
            ->orderBy('MaSP', 'desc')
            ->paginate(7);

        if ($key = request()->key) {
            $data = sanpham::with('loai')
                ->where('TenSP', 'like', '%' . $key . '%')
                ->paginate(7);
            // $data = sanpham::with('loai')->where('TenSP','like','%'.$key.'%')->orWhere('MaSP','like','%'.$key.'%')->paginate(7);
        }
        return View('admin/qlsanpham/view1')->with(compact('data'));
    }

    public function create()
    {
        return View('admin/qlsanpham/insert', ['loai' => loai::all(), 'khuyenmai' => Khuyenmai::all()]);
    }

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
                'upload_file' => 'required|image|mimes:png,jpg,jpeg,bmp,webp',
                'MaLoai' => 'required',
            ],
            [
                'MaSP.required' => 'Không được bỏ trống.',
                'MaSP.unique' => 'Mã sản phẩm đã tồn tại.',
                'TenSP.required' => 'Không được bỏ trống.',
                'NgayThem.required' => 'Không được bỏ trống.',
                'MoTa.required' => 'Không được bỏ trống.',
                'GiaTien.required' => 'Không được bỏ trống.',
                'KichThuoc.required' => 'Không được bỏ trống.',
                'upload_file.required' => 'Không được bỏ trống.',
                'upload_file.image' => 'Sai định dạng ảnh.',
                'upload_file.mimes' => 'Sai định dạng ảnh.',
                'MaLoai.required' => 'Không được bỏ trống.',
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
        $request->validate(
            [
                'TenSP' => 'required',
                'MoTa' => 'required',
                'GiaTien' => 'required',
                'KichThuoc' => 'required',
                'upload_file' => 'required|image|mimes:png,jpg,jpeg,bmp,webp',
                'MaLoai' => 'required',
            ],
            [
                'TenSP.required' => 'Không được bỏ trống.',
                'MoTa.required' => 'Không được bỏ trống.',
                'GiaTien.required' => 'Không được bỏ trống.',
                'KichThuoc.required' => 'Không được bỏ trống.',
                'upload_file.image' => 'Sai định dạng ảnh.',
                'upload_file.mimes' => 'Sai định dạng ảnh.',
                'MaLoai.required' => 'Không được bỏ trống.',
            ],
        );
        $sanpham = sanpham::find($id);
        $sanpham->TenSP = $request->input('TenSP');
        $sanpham->MoTa = $request->input('MoTa');
        $sanpham->GiaTien = $request->input('GiaTien');
        $sanpham->KichThuoc = $request->input('KichThuoc');

        if ($request->hasFile('upload_file')) {
            $file = $request->upload_file;

            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            $file->move(public_path('images/products/'), $file_name);
            $request->merge(['HinhAnh' => $file_name]);
            $sanpham->HinhAnh = $file_name;
        }

        $sanpham->MaLoai = $request->input('MaLoai');
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