@extends('layout')
<style>
    .container {
        padding-top: 12px;
    }

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
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Tạo khuyến mãi</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('khuyenmai.index')}}" class="btn btn-primary float-end">BACK</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('khuyenmai.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <td>MÃ KHUYẾN MÃI</td>
                        <input type="text" name="MaKM" class="form-control">
                        @if($errors->has('MaKM'))
                        <span class="error-text">
                            {{$errors->first('MaKM')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>TÊN KHUYẾN MÃI</td>
                        <input type="text" name="TenKM" class="form-control">
                        @if($errors->has('TenKM'))
                        <span class="error-text">
                            {{$errors->first('TenKM')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>PHẦN TRĂM</td>
                        <input type="text" name="PhanTram" class="form-control">
                        @if($errors->has('PhanTram'))
                        <span class="error-text">
                            {{$errors->first('PhanTram')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>NGÀY BẮT ĐẦU</td>
                        <input type="date" name="NgayBatDau" class="form-control">
                        @if($errors->has('NgayBatDau'))
                        <span class="error-text">
                            {{$errors->first('NgayBatDau')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>NGÀY KẾT THÚC</td>
                        <input type="date" name="NgayKetThuc" class="form-control">
                        @if($errors->has('NgayKetThuc'))
                        <span class="error-text">
                            {{$errors->first('NgayKetThuc')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>TRẠNG THÁI</td>
                        <input type="text" name="TrangThai" class="form-control">
                        @if($errors->has('TrangThai'))
                        <span class="error-text">
                            {{$errors->first('TrangThai')}}
                        </span>
                        @endif
                    </div>
                </div>

        </div>
        <button type="submit" class="btn btn-success mt-4"> Lưu</button>
        </form>
    </div>
</div>
</div>
