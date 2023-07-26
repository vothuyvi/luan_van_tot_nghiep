<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Tintuc;
use Illuminate\Http\Request;
use File;

class TinTucController extends Controller
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
        return View('admin/qltintuc/view', ['Tintuc' => Tintuc::paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View('admin/qltintuc/insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'TieuDe' => 'required',
                'NoiDung' => 'required',
                'upload_file' => 'required|image|mimes:png,jpg,jpeg,bmp,webp',
                'NgayDang' => 'required',
            ],
            [
                'TieuDe.required' => 'Không được bỏ trống',
                'NoiDung.required' => 'Không được bỏ trống',
                'NgayDang.required' => 'Không được bỏ trống',
                'upload_file.required' => 'Không được bỏ trống.',
                'upload_file.image' => 'Sai định dạng ảnh.',
                'upload_file.mimes' => 'Sai định dạng ảnh.',
            ],
        );
        if ($request->hasFile('upload_file')) {
            $file = $request->upload_file;
            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            $file->move(public_path('images/news/'), $file_name);
            $request->merge(['HinhAnh' => $file_name]);
        }
        Tintuc::create($request->all());
        return redirect()
            ->route('tintuc.index')
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
        $tintuc = Tintuc::find($id);
        return view('admin/qltintuc/edit', compact('tintuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'TieuDe' => 'required',
                'NoiDung' => 'required',
                'upload_file' => 'required|image|mimes:png,jpg,jpeg,bmp,webp',
                'NgayDang' => 'required',
            ],
            [
                'TieuDe.required' => 'Không được bỏ trống',
                'NoiDung.required' => 'Không được bỏ trống',
                'NgayDang.required' => 'Không được bỏ trống',
                'upload_file.image' => 'Sai định dạng ảnh.',
                'upload_file.mimes' => 'Sai định dạng ảnh.',
            ],
        );
        $tintuc = Tintuc::find($id);
        $tintuc->TieuDe = $request->input('TieuDe');
        $tintuc->NoiDung = $request->input('NoiDung');

        if ($request->hasFile('upload_file')) {
            $file = $request->upload_file;
            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            $file->move(public_path('images/news/'), $file_name);
            $request->merge(['HinhAnh' => $file_name]);
            $tintuc->HinhAnh = $file_name;
        }

        $tintuc->NgayDang = $request->input('NgayDang');
        $tintuc->update();
        return redirect()
            ->route('tintuc.index')
            ->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tintuc $tintuc)
    {
        //
        $tintuc->delete();
        return redirect()
            ->route('tintuc.index')
            ->with('success', 'Xóa thành công');
    }
}