<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\DonHang;
use App\Models\Admin\TrangThaiDon;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return View('admin/qldonhang/view',['data'=>DonHang::all()]);
        $donhang = DonHang::with('thanhtoan')->get();
        return View('admin/qldonhang/view')->with(compact('donhang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $donhang = DonHang::find($id);
        return view('admin/qldonhang/edit', compact('donhang'), ['TT' => TrangThaiDon::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donhang = DonHang::find($id);
        $donhang->MaTT = $request->input('MaTT');
        $donhang->update();
        return redirect()
            ->route('donhang.index')
            ->with('success', 'cập nhập trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
