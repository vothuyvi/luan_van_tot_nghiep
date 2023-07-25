<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\DonHang;
use App\Models\Admin\Khachhang;
use App\Models\Admin\Sanpham;
use App\Models\Admin\TrangThaiDon;
use Illuminate\Http\Request;
use Mail;
class DonHangController extends Controller
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
        $donhang = DonHang::with('thanhtoan')->paginate(6);
        if ($key = request()->key) {
            $donhang = DonHang::where('MaDH', 'like', $key)->paginate(6);
        }
        return View('admin/qldonhang/view')->with(compact('donhang'));
    }

    //update
    public function update(Request $request, string $id)
    {
        // $donhang = DonHang::find($id);
        // $donhang->MaTT = $request->input('MaTT');
        // $donhang->update();
        // return redirect()
        //     ->route('donhang.index')
        //     ->with('success', 'cập nhập trạng thái thành công');

        $donhang = DonHang::find($id);
        //  dd($donhang);
        // $MaDH=DonHang::get('MaDH');
        // $MaTT=DonHang::get('MaTT');
        // // dd($MaTT);
        // $order = Donhang::with('chitietdonhang')
        // ->where('MaDH', $MaDH)
        // ->first();
        // dd($order);
        // dd($ChiTietDonHang);
        // $ChiTietDonHang->save();
        $MaDH = $request->get('MaDH');
        // dd($MaDH);
        $MaTT = $request->get('MaTT');
        // dd($MaTT);
        $order = Donhang::with('chitietdonhang')
            ->where('MaDH', $MaDH)
            ->first();
        // dd($order);
        if ($order) {
            $order->MaTT = $MaTT;
            $order->save();
            // cap nhat so luong san pham
            $chitietdonhang = $donhang->MaDH;
            if ($chitietdonhang) {
                foreach ($chitietdonhang as $item) {
                    $sanpham = sanpham::findOrfail($item->MaSP);
                    if ($sanpham) {
                        $newSL = $sanpham->SoLuong - $item->quantity;
                        $sanpham->SoLuong = $newSL > 0 ? $newSL : 0;
                        $sanpham->save();
                    }
                }
            }
        }
        // $MaTT = $request->get('MaTT');
        // dd($MaTT);
        $donhang->MaTT = $request->input('MaTT');
        $donhang->update();
        return redirect()
            ->route('donhang.index')
            ->with('success', 'cập nhập trạng thái thành công');
    }

    public function SendMail()
    {
    }
    public function chitiet(Request $request)
    {
        $MaDH = $request->route('MaDH');
        $donhang = Donhang::with('chitietdonhang', 'chitietdonhang.sanpham')
            ->where('MaDH', $MaDH)
            ->first();
        $MaKH = $donhang->MaKH;
        $khachhang = Khachhang::where('MaKH', $MaKH)->first();
        $chitietdonhang = $donhang->chitietdonhang;
        $tongtien = 0;
        $khuyenmai = 0;
        if ($chitietdonhang) {
            foreach ($chitietdonhang as $item) {
                $sanpham = Sanpham::findOrfail($item->MaSP);
                $tongtien += $item->quantity * $sanpham->GiaTien;
            }
        }
        if ($donhang->MaKM) {
            // $khuyenmai = Khuyenmai::where('MaKM', $order->MaKM)->first();
            $khuyenmai = $donhang->TongTienDonHang - $tongtien;
            $khuyenmai = number_format($khuyenmai, 0, '', ',');
        }
        $tongtien = number_format($tongtien, 0, '', ',');

        return view('admin/qldonhang/chitiet')
            ->with('donhang', $donhang)
            ->with('tongtien', $tongtien)
            ->with('khachhang', $khachhang)
            ->with('khuyenmai', $khuyenmai);
    }

    public function showUpdateStatus(Request $request)
    {
        $MaDH = $request->route('MaDH');
        $donhang = Donhang::where('MaDH', $MaDH)->first();
        if ($donhang->MaTT == '4' || $donhang->MaTT == '5') {
            return redirect('chitietdonhang/' . $donhang->MaDH);
        } else {
            return view('admin/qldonhang/update')->with('donhang', $donhang);
        }
    }

    public function updateStatus(Request $request)
    {
        $MaDH = $request->route('MaDH');
        $MaTT = $request->MaTT;
        $donhang = Donhang::with('chitietdonhang')
            ->where('MaDH', $MaDH)
            ->first();

        $MaTTHienTai = $donhang->MaTT;
        if ($MaTT == '2') {
            if ($MaTTHienTai != '2') {
                foreach ($donhang->chitietdonhang as $item) {
                    $sanpham = Sanpham::where('MaSP', $item->MaSP)->first();
                    if ($sanpham) {
                        $newSL = $sanpham->SoLuong - $item->quantity;
                        $sanpham->SoLuong = $newSL > 0 ? $newSL : 0;
                        $sanpham->save();
                    }
                }
            }
        }
        if ($MaTT == '5') {
            if ($MaTTHienTai == '2' || $MaTTHienTai == '3') {
                foreach ($donhang->chitietdonhang as $item) {
                    $sanpham = Sanpham::where('MaSP', $item->MaSP)->first();
                    if ($sanpham) {
                        $newSL = $sanpham->SoLuong + $item->quantity;
                        $sanpham->SoLuong = $newSL > 0 ? $newSL : 0;
                        $sanpham->save();
                    }
                }
            }
        }
        $donhang->MaTT = $MaTT;
        $donhang->save();
        return redirect('chitietdonhang/' . $donhang->MaDH);
    }
}