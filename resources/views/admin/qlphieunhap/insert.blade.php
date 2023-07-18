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
                <h2>Thêm loại sản phẩm</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('phieunhap.index')}}" class="btn btn-primary float-end"> Danh sách phiếu nhập</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('phieunhap.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                        <div class="form-group">
                            <td>MÃ PHIẾU NHẬP</td>
                            <input type="text" name="MaPN" class="form-control">
                            @if($errors->has('MaPN'))
                            <span class="error-text">
                                {{$errors->first('MaPN')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>NGÀY NHẬP</td>
                            <input type="date" name="NgayNhap" class="form-control">
                            @if($errors->has('NgayNhap'))
                            <span class="error-text">
                                {{$errors->first('NgayNhap')}}
                            </span>
                            @endif
                        </div>
                </div>
                <button type="submit" class="btn btn-success mt-4"> Lưu</button>
            </form>
        </div>
    </div>
</div>
