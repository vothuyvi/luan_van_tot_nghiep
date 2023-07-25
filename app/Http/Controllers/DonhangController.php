<?php

namespace App\Http\Controllers;
use App\Models\Donhang;
use App\Models\Trangthaithanhtoan;
use App\Models\Chitietdonhang;
use App\Models\Sanpham;
use App\Models\Khachhang;
use App\Models\Khuyenmai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ResponseApi;
use Illuminate\Support\Facades\Mail;
use App\Mail\Order;

class DonhangController extends Controller
{
    //
    public function index(Request $request)
    {
        try {
            $MaTT = $request->get('MaTT', '');
            $user = Auth::user();
            $results = Donhang::with('chitietdonhang', 'chitietdonhang.sanpham');
            if ($MaTT != 0) {
                $results = $results->where('MaTT', $MaTT);
            }
            $results = $results
                ->where('MaKH', $user->MaKH)
                ->orderBy('MaDH', 'desc')
                ->get();
            return ResponseApi::success($results, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }

    public function checkOut(Request $request)
    {
        try {
            $user = Auth::user();
            $order = new Donhang();
            // $order->email = $request->email;
            $order->TenNguoiNhan = $request->TenNguoiNhan;
            $order->DiaChiNguoiNhan = $request->DiaChiNguoiNhan;
            $order->SDTNguoiNhan = $request->SDTNguoiNhan;
            $order->GhiChu = $request->GhiChu;
            $order->MaPT = $request->MaPT;
            $order->MaTT = '1';
            $order->MaThanhToan = '02';
            $order->MaKH = $user->MaKH;
            $order->MaKM = $request->MaKM;
            $order->NgayDat = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $order->TongTienDonHang = $request->TongTienDonHang;
            $order->save();
            foreach ($request->listSP as $item) {
                $chitietdonhang = new Chitietdonhang();
                $chitietdonhang->MaSP = $item['MaSP'];
                $chitietdonhang->MaDH = $order->MaDH;
                $chitietdonhang->total = $item['total'];
                $chitietdonhang->quantity = $item['quantity'];
                $chitietdonhang->save();
            }
            return ResponseApi::success($order, '');
        } catch (\Exception $e) {
            dd($e);
            return ResponseApi::fails('Server Error!');
        }
    }

    public function payment(Request $request)
    {
        $appURL = config('app.url');
        $TongTien = $request->get('TongTien');
        $MaDH = $request->get('MaDH');
        $vnp_TmnCode = 'Z8BRNGSE'; //Mã website tại VNPAY
        $vnp_HashSecret = 'GMKBLBRAUBGXHPLNJSRDTAAKEHOWGAZJ'; //Chuỗi bí mật
        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $vnp_Returnurl = $appURL . 'return-vnpay';
        $vnp_TxnRef = $MaDH; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'ThanhToanDonHang';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $TongTien * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = '192.168.1.34';

        $inputData = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_Returnurl,
            'vnp_TxnRef' => $vnp_TxnRef,
            'vnp_BankCode' => 'NCB',
        ];

        ksort($inputData);
        $query = '';
        $i = 0;
        $hashdata = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . '?' . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($data)]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function paymentMoMo(Request $request)
    {
        $appURL = config('app.url');
        $TongTien = $request->get('TongTienDonHang');
        $MaDH = $request->get('MaDH');
        $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = 'Thanh toán qua ATM MoMo';
        $amount = $TongTien;
        $orderId = time() . '_' . $MaDH;
        $redirectUrl = $appURL . 'return-momo';
        $ipnUrl = $appURL . 'return-momo';
        $extraData = '';

        $requestId = time() . '_' . $MaDH;
        $requestType = 'payWithATM';
        //before sign HMAC SHA256 signature
        $rawHash =
            'accessKey=' .
            $accessKey .
            '&amount=' .
            $amount .
            '&extraData=' .
            $extraData .
            '&ipnUrl=' .
            $ipnUrl .
            '&orderId=' .
            $orderId .
            '&orderInfo=' .
            $orderInfo .
            '&partnerCode=' .
            $partnerCode .
            '&redirectUrl=' .
            $redirectUrl .
            '&requestId=' .
            $requestId .
            '&requestType=' .
            $requestType;
        $signature = hash_hmac('sha256', $rawHash, $secretKey);
        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => 'Test',
            'storeId' => 'MomoTestStore',
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
        ];
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true); // decode json
        // dd($jsonResult);

        //Just a example, please check more in there
        // return redirect()->to($jsonResult['payUrl']);
        return ResponseApi::success($jsonResult, '');
        // header('Location: ' . $jsonResult['payUrl']);
    }

    public function updateOrder(Request $request)
    {
        $MaDH = $request->get('MaDH');
        $MaThanhToan = $request->get('MaThanhToan');
        $MaTT = $request->get('MaTT');
        $user = Auth::user();
        $order = Donhang::with('chitietdonhang', 'chitietdonhang.sanpham')
            ->where('MaDH', $MaDH)
            ->first();
        if ($order) {
            $order->MaThanhToan = $MaThanhToan;
            $order->MaTT = $MaTT;
            $order->save();
            // cap nhat so luong san pham
            $chitietdonhang = $order->chitietdonhang;
            $tongtien = 0;
            $khuyenmai = 0;
            if ($chitietdonhang) {
                foreach ($chitietdonhang as $item) {
                    $sanpham = Sanpham::findOrfail($item->MaSP);
                    if ($sanpham) {
                        $newSL = $sanpham->SoLuong - $item->quantity;
                        $sanpham->SoLuong = $newSL > 0 ? $newSL : 0;
                        $sanpham->save();
                    }
                    $tongtien += $item->quantity * $sanpham->GiaTien;
                }
            }
            if ($order->MaKM) {
                // $khuyenmai = Khuyenmai::where('MaKM', $order->MaKM)->first();
                $khuyenmai = $order->TongTienDonHang - $tongtien;
                $khuyenmai = number_format($khuyenmai, 0, '', ',');
            }
            $tongtien = number_format($tongtien, 0, '', ',');
            if ($order->MaTT == '2') {
                $mailData = [
                    'email' => $user->email,
                    'tongtien' => $tongtien,
                    'thanhtien' => number_format($order->TongTienDonHang, 0, '', ','),
                    'khuyenmai' => $khuyenmai,
                    'orderData' => $order->chitietdonhang,
                    'MaPT' => $order->MaPT,
                    'MaThanhToan' => $order->MaThanhToan,
                    'DiaChiNguoiNhan' => $order->DiaChiNguoiNhan,
                    'SDTNguoiNhan' => $order->SDTNguoiNhan,
                    'TenNguoiNhan' => $order->TenNguoiNhan,
                    'NgayDat' => date('d/m/Y', strtotime($order->NgayDat)),
                ];
                Mail::to($user->email)->send(new Order($mailData));
            }
            return ResponseApi::success($order, '');
        }
    }

    public function orderDetail(Request $request)
    {
        try {
            $user = Auth::user();
            $MaDH = $request->MaDH;
            $order = Donhang::with('chitietdonhang', 'chitietdonhang.sanpham')
                ->where('MaDH', $MaDH)
                ->first();
            return ResponseApi::success($order, '');
        } catch (\Exception $e) {
            return ResponseApi::fails('Server Error!');
        }
    }
}