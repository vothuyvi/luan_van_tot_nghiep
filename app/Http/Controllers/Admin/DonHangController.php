<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\DonHang;
use App\Models\Admin\Sanpham;
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
    public function chitiet(Request $request)
    {
        $MaDH = $request->route('MaDH');
        $donhang = Donhang::with('chitietdonhang', 'chitietdonhang.sanpham')
            ->where('MaDH', $MaDH)
            ->first();
        // $chitietdonhang = $donhang->chitietdonhang;
        // $tongtien = 0;
        // $khuyenmai = 0;
        // if ($chitietdonhang) {
        //     foreach ($chitietdonhang as $item) {
        //         $sanpham = Sanpham::findOrfail($item->MaSP);
        //         $tongtien += $item->quantity * $sanpham->GiaTien;
        //     }
        // }
        // if ($donhang->MaKM) {
        //     // $khuyenmai = Khuyenmai::where('MaKM', $order->MaKM)->first();
        //     $khuyenmai = $donhang->TongTienDonHang - $tongtien;
        //     $khuyenmai = number_format($khuyenmai, 0, '', ',');
        // }
        // $tongtien = number_format($tongtien, 0, '', ',');

        return view('admin/qldonhang/chitiet')->with('donhang', $donhang);
    }
    public function updateStatus(Request $request)
    {
        $MaDH = $request->route('MaDH');
        return view('admin/qldonhang/update');
    }
}