<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\ChiTietPhieuNhap;
use App\Models\Admin\PhieuNhap;
use App\Models\Admin\sanpham;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ChiTietPhieuNhapController extends Controller
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
        return View('admin/qlchitietphieunhap/view', ['data' => ChiTietPhieuNhap::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View('admin/qlchitietphieunhap/insert', ['sanpham' => sanpham::all(), 'phieunhap' => PhieuNhap::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'MaSP' => 'required',
                'MaPN' => 'required',
                'GiaTien' => 'nullable',
                'SoLuong' => 'required',
            ],
            [
                'MaSP.required' => 'Không được bỏ trống',
                'MaPN.required' => 'Không được bỏ trống',
                // 'GiaTien.required' => 'Không được bỏ trống',
                'SoLuong.required' => 'Không được bỏ trống',
            ],
        );
        $ChiTietPhieuNhap = new ChiTietPhieuNhap();
        $ChiTietPhieuNhap->MaSP = $request->MaSP;
        $ChiTietPhieuNhap->MaPN = $request->MaPN;
        $ChiTietPhieuNhap->GiaTien = $request->GiaTien;
        $ChiTietPhieuNhap->SoLuong = $request->SoLuong;
        // dd($ChiTietPhieuNhap);
        $ChiTietPhieuNhap->save();
        if ($ChiTietPhieuNhap) {
            $sanpham = sanpham::findOrfail($ChiTietPhieuNhap->MaSP);
            // dd($sanpham->SoLuong);
            if ($sanpham) {
                $sanpham->SoLuong = $sanpham->SoLuong + $ChiTietPhieuNhap->SoLuong;
                $sanpham->save();
            }
        }
        return redirect()
            ->route('phieunhap.index')
            ->with('success', 'Thêm thành công');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $chitiet = ChiTietPhieuNhap::find($id);
        return view('admin/qlchitietphieunhap/edit', compact('chitiet'), ['sanpham' => sanpham::all(), 'phieunhap' => PhieuNhap::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $chitiet = ChiTietPhieuNhap::find($id);
        $chitiet->MaSP = $request->input('MaSP');
        $chitiet->MaPN = $request->input('MaPN');
        $chitiet->GiaTien = $request->input('GiaTien');
        $chitiet->PhieuNhap = $request->input('PhieuNhap');
        $chitiet->update();
        return redirect()
            ->route('phieunhap.index')
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
