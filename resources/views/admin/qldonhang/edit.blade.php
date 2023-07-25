@extends('layout')
<style>
    .select {
        border: none;
        padding-left: 30px;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Cập nhập trạng thái đơn</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('donhang.index')}}" class="btn btn-primary float-end"> Danh đơn hàng</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('donhang.update',$donhang->MaDH)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                            <p style="color: red;font-weight: bold;">THÔNG TIN ĐƠN</p>
                        </div>
                        <div class="form-group">
                            <p>Email: {{$donhang->email}}</p>
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
                            <P>Phương thức thanh toán: {{$donhang->MaPT}}</P>
                        </div>

                        <div class="form-group">
                            <P>Trạng thái đơn hàng hiện tại:
                                @if ($donhang->MaTT== 1)
                                Đang chờ duyệt
                                @elseif ($donhang->MaTT== 2)
                                Đã duyệt
                                @elseif ($donhang->MaTT== 3)
                                Đang vận chuyển
                                @elseif ($donhang->MaTT== 4)
                                Hoàn thành
                                @elseif ($donhang->MaTT== 5)
                                Đã hủy
                                @endif</P>
                        </div>
                        <div class="form-group">
                            <td>Thay đổi trạng thái đơn hàng</td>
                            <select name="MaTT" id="" class="select">
                            <!-- <option>{{$donhang->MaTT}}</option> -->
                                @foreach($TT as $id=>$value)
                                <option value="{{$value->MaTT}}">{{$value->TrangThaiDon}}</option>

                                @endforeach
                            </select>
                        </div>
                        <P> </P>
                        <div class="form-group">
                            <P>Trạng thái thanh toán:
                                @if($donhang->MaThanhToan==01)
                            <a href="https://sandbox.vnpayment.vn/merchantv2/Home/Dashboard.htm" class=""> {{$donhang->thanhtoan->TrangThaiThanhToan}}</a>
                            @else
                            {{$donhang->thanhtoan->TrangThaiThanhToan}}</P>
                            @endif
                        </div>
                        <div class="form-group">
                            <P>Mã khách hàng: {{$donhang->MaKH}}</P>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <p style="color: red;font-weight: bold;">SẢN PHẨM</p>
                        </div>
                        @foreach($ChiTietDon as $value)
                            @if($value->MaDH==$donhang->MaDH)
                            <div class="form-group">
                                <p>Mã sản phẩm: {{$value->MaSP}}</p>
                            </div>
                            <div class="form-group">
                                <P>Số lượng: {{$value->quantity}}</P>
                            </div>
                            <div class="form-group">
                                <P>Giá tiền: {{$value->total}}</P>
                            </div>
                            @endif

                        @endforeach
                    </div>


                </div>
        </div>

        <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
        </form>
    </div>
</div>
