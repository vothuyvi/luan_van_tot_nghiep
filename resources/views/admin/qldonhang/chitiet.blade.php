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
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5>Chi tiết đơn hàng</h5>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group">
                <p>Mã đơn hàng: {{$donhang->MaDH}}</p>
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
                        @elseif ($donhang->MaTT== 'PTOL')
                        THANH TOÁN TRỰC TUYẾN VỚI VNPAY.
                        @elseif ($donhang->MaTT== 'PTOLMOMO')
                        THANH TOÁN TRỰC TUYẾN VỚI MOMO.
                        @endif
                    </span>
                </P>
            </div>
            <div class="form-group">
                <P>Trạng thái đơn hàng:
                    <span class="">
                        @if ($donhang->MaTT== 1)
                        Đang chờ duyệt
                        @elseif ($donhang->MaTT== 2)
                        Đã duyệt
                        @elseif ($donhang->MaTT== 3)
                        Đang giao
                        @elseif ($donhang->MaTT== 4)
                        Hoàn thành
                        @elseif ($donhang->MaTT== 5)
                        Đã hủy
                        @endif
                    </span>
                </P>
            </div>
            <!-- <div>
                <a href="{{'update/'.$donhang->MaDH}}" class="btn btn-success">Cập nhập trạng thái</a>
                @csrf
            </div> -->
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
                        @php
                        $chitietdonhang = $donhang->chitietdonhang;
                        $tongtien = 0;
                        @endphp
                        @foreach($chitietdonhang as $id=>$value)
                        <tr>
                            <td>{{$value->MaSP}}</td>
                            <td><img src="{{ asset('images/products/' .$value->sanpham->HinhAnh)}}" alt="" class="img
                            ">
                            </td>
                            <td>{{$value->sanpham->TenSP}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>{{number_format($value->sanpham->GiaTien, 0, '', ',')}} đ</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Tổng tiền: </td>
                            <td>
                                đ
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Khuyến mãi: </td>
                            <td> đ</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Thành tiền: </td>
                            <td>{{number_format($donhang->TongTienDonHang, 0, '', ',')}} đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>