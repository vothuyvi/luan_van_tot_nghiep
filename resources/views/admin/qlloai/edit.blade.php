@extends('layout')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Sửa loại sản phẩm</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('loai.index')}}" class="btn btn-primary float-end"> Danh các gia vị</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('loai.update',$loai->MaLoai)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <td>TÊN LOẠI SẢN PHẨM</td>
                            <input type="text" name="TenLoai" value="{{$loai->TenLoai}}" class="form-control">
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
            </form>
        </div>
    </div>
</div>

