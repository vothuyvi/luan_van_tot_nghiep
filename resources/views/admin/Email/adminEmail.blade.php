@extends('layout')
<style>
.form-group1 {
    display: flex;
    padding-bottom: 100px;
    padding-left: 12px;
    border: 1px solid #ced4da;

}

.select {
    padding-left: 12px;
    border: none;
}

.choice {
    display: flex;
}

.type {
    padding-top: 12px;
}

.KM {
    padding-top: 100px;
}
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Sửa sản phẩm</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('donhang.index')}}" class="btn btn-primary float-end">Back</a>
            </div>
        </div>
        <div class="card-body">
            <!-- <form action="{{route('mail.update',$mail->MaDH)}}" method="PUT"> -->
                <div class="row">
                        <div class="form-group">
                            <td>MÃ ĐƠN HÀNG</td>
                            <input type="text" name="MaDH" value="{{$mail->MaDH}}" class="form-control" readonly>

                        </div>
                        <div class="form-group">
                            <td>EMAIL</td>
                            <input type="text" name="email" value="{{$mail->email}}" readonly
                                class="form-control">

                        </div>
                        <div class="form-group">
                            <td>TÊN NGƯỜI NHẬN</td>
                            <input type="text" name="TenNguoiNhan" value="{{$mail->TenNguoiNhan}}" class="form-control"readonly>

                        </div>
                        <div class="form-group">
                            <td>ĐỊA CHỈ NGƯỜI NHẬN</td>
                            <input type="text" name="DiaChiNguoiNhan" value="{{$mail->DiaChiNguoiNhan}}" class="form-control"readonly>

                        </div>
                    </div>
                        <div class="form-group">
                            <td>SỐ ĐIỆN THOẠI NGƯỜI NHẬN</td>
                            <input type="text" name="SDTNguoiNhan" value="{{$mail->SDTNguoiNhan}}" class="form-control"readonly>

                        </div>
                        <div class="form-group">
                            <td>TỔNG TIỀN</td>
                            <input type="text" name='TongTienDonHang' class="form-control" value="{{$mail->TongTienDonHang}}" readonly>

                        </div>
                        <div class="form-group">
                            <td>PHƯƠNG THỨC THANH TOÁN</td>
                            <input type="text" name='MaTT' class="form-control" value="{{$mail->MaPT}}"readonly>

                        </div>
                        <div class="form-group">
                            <td>NGÀY ĐẶT</td>
                            <input type="text" name='NgayDat' class="form-control" value="{{$mail->NgayDat}}" readonly>
                        </div>

                        <div class="form-group">
                            <td>LỜI CÁM ƠN</td>
                            <input type="text" name='' class="form-control" >
                        </div>


                </div>
                <a type="button" href="{{route('name')}}" class="btn btn-primary float-end">Send mail</a>
            <!-- </form> -->
        </div>
    </div>
</div>
