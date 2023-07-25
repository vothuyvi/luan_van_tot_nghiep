@extends('menu')
<style>
.select {
    border: none;
    padding-left: 30px;
}

.container {
    padding-top: 70px;
}
</style>
<div class="container">
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <h5>Cập nhật trạng thái đơn hàng</h5>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <form action="" method="post">


            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <td>Thay đổi trạng thái đơn hàng</td>
                        <select name="" id="" class="select">
                            <option value="1">Đang chờ duyệt</option>
                            <option value="2">Đã duyệt</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
        </form>

    </div>
</div>