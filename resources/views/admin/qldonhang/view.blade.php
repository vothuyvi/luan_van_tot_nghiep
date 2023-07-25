@extends('menu')
<style>
.container {
    padding-top: 70px;
}

.table {
    text-align: center;
}
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5>Quản lý đơn hàng</h5>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered h">
                <thead>
                    <tr>
                        <th>MÃ ĐƠN HÀNG</th>
                        <th>TÊN NGƯỜI NHẬN</th>
                        <!-- <th>ĐỊA CHỈ NGƯỜI NHẬN</th> -->
                        <th>SỐ ĐIỆN THOẠI</th>
                        <th>NGÀY ĐẶT</th>
                        <th>TRẠNG THÁI ĐƠN</th>
                        <th>THAO TÁC</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($donhang as $id=>$value)
                    <tr>
                        <td>{{$value->MaDH}}</td>
                        <td>{{$value->TenNguoiNhan}}</td>
                        <!-- <td>{{$value->DiaChiNguoiNhan}}</td> -->
                        <td>{{$value->SDTNguoiNhan}}</td>
                        <td>{{date('d/m/Y H:m:s', strtotime($value->NgayDat))}}</td>
                        <td>
                            @if ( $value->MaTT== 1)
                            Đang chờ duyệt
                            @elseif ($value->MaTT== 2)
                            Đã duyệt đơn
                            @elseif ($value->MaTT== 3)
                            Đang giao
                            @elseif ($value->MaTT== 4)
                            Hoàn thành
                            @elseif ($value->MaTT== 5)
                            Đã hủy
                            @elseif ($value->MaTT== 6)
                            Trả hàng/Hoàn tiền
                            @endif </td>
                        <td col>
                            <a href="{{'chitiet/'.$value->MaDH}}" class="btn btn-info">Xem chi tiết</a>
                            <a href="{{'update/'.$value->MaDH}}" class="btn btn-success">Cập nhập trạng thái</a>
                            @csrf
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>