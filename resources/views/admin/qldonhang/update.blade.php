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
        <form action="/chitietdonhang/update/{{request()->route('MaDH')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <td>Thay đổi trạng thái đơn hàng</td>
                        <select name="MaTT" id="" class="select">
                            @if($donhang->MaTT == 1)
                            <option value="1" selected>Đang chờ duyệt</option>
                            @else
                            <option value="1">Đang chờ duyệt</option>
                            @endif
                            @if($donhang->MaTT == 2)
                            <option value="2" selected>Đã duyệt đơn</option>
                            @else
                            <option value="2">Đã duyệt</option>
                            @endif
                            @if($donhang->MaTT == 3)
                            <option value="3" selected>Đang giao</option>
                            @else
                            <option value="3">Đang giao</option>
                            @endif
                            @if($donhang->MaTT == 4)
                            <option value="4" selected>Hoàn thành</option>
                            @else
                            <option value="4">Hoàn thành</option>
                            @endif
                            @if($donhang->MaTT == 5)
                            <option value="5" selected>Đã huỷ</option>
                            @else
                            <option value="5">Đã huỷ</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
        </form>

    </div>
</div>