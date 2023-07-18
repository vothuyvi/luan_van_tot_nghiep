<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Tintuc;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return View('admin/qltintuc/view', ['Tintuc' => Tintuc::all()]);
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
        //
        $request->validate(
            [
                'TieuDe' => 'required',
                'NoiDung' => 'required',
                'NgayDang' => 'required',
            ],
            [
                'TieuDe.required' => 'Không được bỏ trống',
                'NoiDung.required' => 'Không được bỏ trống',
                'NgayDang.required' => 'Không được bỏ trống',
            ],
        );
        Tintuc::create($request->all());
        return redirect()
            ->route('tintuc.index')
            ->with('success', 'Thêm thành công');
        $type = Tintuc::find($request);
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
