<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\loai;
use Illuminate\Http\Request;

class LoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // dd(loai::all());
        return view('admin/qlloai/view')->with('Loai', loai::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View('admin/qlloai/insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate(
            [
                'MaLoai' => 'required|unique:loaisp',
                'TenLoai' => 'required|unique:loaisp',
            ],
            [
                'MaLoai.required' => 'Không bỏ trống',
                'TenLoai.required' => 'Không được bỏ trống',
                'MaLoai.unique' => 'Mã sản phẩm không được trùng',
                'TenLoai.unique' => 'Tên loại sản phẩm đã có',
            ],
        );
        loai::create($request->all());
        return redirect()
            ->route('loai.index')
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
    public function edit(string $id)
    {
        //
        $loai = loai::find($id);
        return view('admin/qlloai/edit', compact('loai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $loai = loai::find($id);
        $loai->TenLoai = $request->input('TenLoai');
        $loai->update();
        return redirect()
            ->route('loai.index')
            ->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loai $loai)
    {
        if ($loai->sanphams->count() > 0) {
            return redirect()
                ->route('loai.index')
                ->with('error', 'Loại này có sản phẩm, không thể xóa được');
        } else {
            $loai->delete();
            return redirect()
                ->route('loai.index')
                ->with('success', 'Xóa thành công');
        }
    }
}
