<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Hinhanh;
use App\Models\Admin\sanpham;
use Illuminate\Http\Request;

class HinhAnhController extends Controller
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
        $data = Hinhanh::paginate(5);
        return View('admin/qlhinhanh/view')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return View('admin/qlhinhanh/insert', ['data' => sanpham::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'upload_file' => 'required|image|mimes:png,jpg,jpeg',
                'MaSP' => 'required',
            ],
            [
                'MaSP.required' => 'Không được bỏ trống',
                'upload_file.required' => 'không được bỏ trống',
            ],
        );
        if ($request->hasFile('upload_file')) {
            $file = $request->upload_file;

            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            $file->move(public_path('images/products/'), $file_name);
        }
        $request->merge(['HinhAnh' => $file_name]);
        // dd($request->all());
        Hinhanh::create($request->all());
        return redirect()
            ->route('hinhanh.index')
            ->with('success', 'Thêm thành công');
    }

    public function edit(string $id)
    {
        $hinhanh = Hinhanh::find($id);
        return view('admin/qlhinhanh/edit', compact('hinhanh'), ['data' => sanpham::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'upload_file' => 'required|image|mimes:png,jpg,jpeg',
                'MaSP' => 'required',
            ],
            [
                'MaSP.required' => 'Không được bỏ trống',
                'upload_file.required' => 'không được bỏ trống',
            ],
        );
        $hinhanh = Hinhanh::find($id);
        if ($request->hasFile('upload_file')) {
            $file = $request->upload_file;
            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            $file->move(public_path('images/products/'), $file_name);
            $hinhanh->HinhAnh = $file_name;
        }
        $request->merge(['HinhAnh' => $file_name]);
        $hinhanh->MaSP = $request->input('MaSP');
        $hinhanh->update();
        return redirect()
            ->route('hinhanh.index')
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