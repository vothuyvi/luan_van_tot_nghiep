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
                <form action="" class="form-inline">
                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="Tìm kiếm tại đây">
                    </div>
                    <button type="submit" class="btn btn-primary  search">
                        <i class='bx bx-search nav_icon'></i>
                    </button>
                </form>

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
                            <span class="error-text1">Đang chờ duyệt</span>
                            @elseif ($value->MaTT== 2)
                            <span class="error-text1">Đã duyệt đơn</span>
                            @elseif ($value->MaTT== 3)
                            <span class="error-text1">Đang giao</span>
                            @elseif ($value->MaTT== 4)
                            <span class="error-text1">Hoàn thành</span>
                            @elseif ($value->MaTT== 5)
                            <span class="error-text">Đã hủy</span>
                            @elseif ($value->MaTT== 6)
                            <span class="error-text1">Trả hàng/Hoàn tiền</span>
                            @endif
                        </td>
                        <td col>
                            <a href="{{'chitietdonhang/'.$value->MaDH}}" class="btn btn-info">Xem chi tiết</a>
                            <a href="{{'update/'.$value->MaDH}}" class="btn btn-success">Cập nhập trạng thái</a>
                            <form action="" method="post" class="form">
                                @if ( $value->MaTT== 4)
                                <a href="{{route('mail.edit',$value->MaDH)}}" class="btn btn-danger">Gửi mail</a>
                                @endif
                            </form>
                            @csrf
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$donhang->appends(request()->all())->links()}}

        </div>
    </div>