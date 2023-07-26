@extends('menu')
<style>
.container {
    padding-top: 70px;
}

.table {
    text-align: center;
}

.img {
    width: 62px;
    height: 62px;

}

td {
    vertical-align: middle !important;
}

.text-right {
    text-align: right;
}
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5>Chi tiết đơn hàng</h5>
                </div>
                <div class="col-md-6">
                    <a href="{{route('donhang.index')}}" class="btn btn-primary float-end">BACK</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group">
                <p>Mã đơn hàng: {{$donhang->MaDH}}</p>
            </div>
            <div class="form-group">
                <P>Email: {{$khachhang->email}}</P>
            </div>
            <div class="form-group">
                <P>Tên người nhận: {{$donhang->TenNguoiNhan}}</P>
            </div>
            <div class="form-group">
                <P>Địa chỉ người nhận: {{$donhang->DiaChiNguoiNhan}}</P>
            </div>
            <div class="form-group">
                <P>Số điện thoại người nhận: {{$donhang->SDTNguoiNhan}}</P>
            </div>
            <div class="form-group">
                <P>Ghi chú: {{$donhang->GhiChu}}</P>
            </div>
            <div class="form-group">
                <P>Phương thức thanh toán:
                    <span>
                        @if ($donhang->MaPT== 'PTOFF')
                        THANH TOÁN KHI NHẬN HÀNG.
                        @elseif ($donhang->MaPT== 'PTOL')
                        THANH TOÁN TRỰC TUYẾN VỚI VNPAY.
                        @elseif ($donhang->MaPT== 'PTOLMOMO')
                        THANH TOÁN TRỰC TUYẾN VỚI MOMO.
                        @endif
                    </span>
                </P>
            </div>
            <div class="form-group">
                <P>Trạng thái thanh toán:
                    <span>
                        @if ($donhang->MaThanhToan== '01')
                        ĐÃ THANH TOÁN.
                        @elseif ($donhang->MaTT== 4)
                        ĐÃ THANH TOÁN.
                        @elseif ($donhang->MaThanhToan== '02')
                        CHƯA THANH TOÁN.
                        @endif
                    </span>
                </P>
            </div>
            <div class="form-group">
                <P>Trạng thái đơn hàng:
                    <span class="">
                        @if ($donhang->MaTT== 1)
                        <span class="error-text1">
                            ĐANG CHỜ DUYỆT
                        </span>
                        @elseif ($donhang->MaTT== 2)
                        <span class="error-text1">
                            ĐÃ DUYỆT ĐƠN
                        </span>
                        @elseif ($donhang->MaTT== 3)
                        <span class="error-text1">
                            ĐANG GIAO
                        </span>
                        @elseif ($donhang->MaTT== 4)
                        <span class="error-text1">
                            HOÀN THÀNH
                        </span>
                        @elseif ($donhang->MaTT== 5)
                        <span class="error-text">
                            ĐÃ HUỶ
                        </span>
                        @endif
                    </span>
                </P>
            </div>
            @if ($donhang->MaTT != '4' && $donhang->MaTT != '5')
            <div>
                <a href="{{'update/'.$donhang->MaDH}}" class="btn btn-success">Cập nhập trạng thái</a>
            </div>
            @endif

            <div class="card-body">
                <table class="table table-bordered h">
                    <thead>
                        <tr>
                            <th>MÃ SẢN PHẨM</th>
                            <th>Hình ảnh</th>
                            <th>TÊN SẢN PHẨM</th>
                            <th>SỐ LƯỢNG</th>
                            <th>ĐƠN GIÁ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donhang->chitietdonhang as $id=>$value)
                        <tr>
                            <td>{{$value->MaSP}}</td>
                            <td><img src="{{ asset('public/images/products/' .$value->sanpham->HinhAnh)}}" alt="" class="img
                            ">
                            </td>
                            <td>{{$value->sanpham->TenSP}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>{{number_format($value->sanpham->GiaTien, 0, '', ',')}} đ</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Tổng tiền: </td>
                            <td>
                                {{$tongtien}} đ
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Khuyến mãi: </td>
                            <td>{{$khuyenmai}} đ</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Thành tiền: </td>
                            <td>{{number_format($donhang->TongTienDonHang, 0, '', ',')}} đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>