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
                <h2></h2>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="card-body">
            <form action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <td>MÃ ĐƠN HÀNG</td>
                            <td></td>
                        </div>

                        <div class="form-group">
                            <td>TÊN NGƯỜI NHẬN</td>

                        </div>
                        <div class="form-group">
                            <td>ĐỊA CHỈ NGƯỜI NHẬN</td>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <td>SỐ ĐIỆN THOẠI NGƯỜI NHẬN</td>
                        </div>
                        <div class="form-group">
                            <td>TỔNG TIỀN</td>

                        </div>
                        <div class="form-group">
                            <td>PHƯƠNG THỨC THANH TOÁN</td>

                        </div>
                        <div class="form-group">
                            <td>NGÀY ĐẶT</td>
                        </div>

                        <div class="form-group">
                            <td>LỜI CÁM ƠN</td>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
