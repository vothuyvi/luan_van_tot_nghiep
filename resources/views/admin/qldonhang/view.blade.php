@extends('menu')
<style>
.container {
    padding-top: 70px;
}

.table {
    text-align: center;
}

td {
    vertical-align: middle !important;
}

.custom-operation {
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-operation form {
    margin-bottom: 0;
    margin-left: 10px;
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
                        <td>{{$value->SDTNguoiNhan}}</td>
                        <td>{{$value->NgayDat}}</td>
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
                        <td class="custom-operation">
                            <a href=" {{'chitietdonhang/'.$value->MaDH}}" class="btn btn-info">Xem chi tiết</a>
                            @csrf
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
                <div class="form-group">
                    <td><a href="https://sandbox.vnpayment.vn/merchantv2/Users/Login.htm?ReturnUrl=%2fmerchantv2%2fTransaction%2fPaymentSearch.htm"
                            class="btn btn-primary mt-4">Quản lý thanh toán VNPAY</a>
                    </td>
                </div>
            </table>
            <div class="mt-4">
                {{$donhang->appends(request()->all())->links()}}
            </div>


        </div>
    </div>