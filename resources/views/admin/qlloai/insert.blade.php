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
    .error-text{
        color: red;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Thêm loại sản phẩm</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('loai.index')}}" class="btn btn-primary float-end"> Danh sách loại</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('loai.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                        <div class="form-group">
                            <td>MÃ LOẠI</td>
                            <input type="text" name="MaLoai" class="form-control">
                            @if($errors->has('MaLoai'))
                            <span class="error-text">
                                {{$errors->first('MaLoai')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>TÊN LOẠI SẢN PHẨM</td>
                            <input type="text" name="TenLoai" class="form-control">
                            @if($errors->has('TenLoai'))
                            <span class="error-text">
                                {{$errors->first('TenLoai')}}
                            </span>
                            @endif
                        </div>
                </div>
                <button type="submit" class="btn btn-success mt-4"> Lưu</button>
            </form>
        </div>
    </div>
</div>
