@extends('layout')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Sửa khuyến mãi</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('khuyenmai.index')}}" class="btn btn-primary float-end"> Danh các khuyến mãi</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('khuyenmai.update',$khuyenmai->MaKM)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group">
                        <td>TÊN KHUYẾN MÃI</td>
                        <input type="text" name="TenKM" value="{{$khuyenmai->TenKM}}" class="form-control">
                        @if($errors->has('TenKM'))
                        <span class="error-text">
                            {{$errors->first('TenKM')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>ĐIỀU KIỆN ÁP DỤNG</td>
                        <input type="text" name="DieuKienApDung" value="{{$khuyenmai->DieuKienApDung}}"
                            class="form-control">
                        @if($errors->has('DieuKienApDung'))
                        <span class="error-text">
                            {{$errors->first('DieuKienApDung')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>PHẦN TRĂM</td>
                        <input type="numnber" name="PhanTram" value="{{$khuyenmai->PhanTram}}" class="form-control">
                        @if($errors->has('PhanTram'))
                        <span class="error-text">
                            {{$errors->first('PhanTram')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>NGÀY BẮT ĐẦU</td>
                        <input type="date" name="NgayBatDau" value="{{$khuyenmai->NgayBatDau}}" class="form-control">
                        @if($errors->has('NgayBatDau'))
                        <span class="error-text">
                            {{$errors->first('NgayBatDau')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>NGÀY KẾT THÚC</td>
                        <input type="date" name="NgayKetThuc" value="{{$khuyenmai->NgayKetThuc}}" class="form-control">
                        @if($errors->has('NgayKetThuc'))
                        <span class="error-text">
                            {{$errors->first('NgayKetThuc')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>TRẠNG THÁI</td>
                        <input type="text" name="TrangThai" value="{{$khuyenmai->TrangThai}}" class="form-control">
                        @if($errors->has('Trạng thái'))
                        <span class="error-text">
                            {{$errors->first('TrangThai')}}
                        </span>
                        @endif
                    </div>
                </div>
        </div>
        <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
        </form>
    </div>
</div>