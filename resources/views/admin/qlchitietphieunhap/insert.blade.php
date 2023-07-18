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
                <h2>Thêm chi tiết phiếu nhập</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('phieunhap.index')}}" class="btn btn-primary float-end"> BACK</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('chitiet.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group1">
                        <td>MÃ SẢN PHẨM</td>
                        <div class="select">
                            <select name="MaSP" id="" class="select">
                                @foreach($sanpham as $id=>$value)
                                <option>{{$value->MaSP}}</option>
                                @endforeach

                            </select>
                            @if($errors->has('MaSP'))
                            <span class="error-text">
                                {{$errors->first('MaSP')}}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group1">
                        <td>MÃ PHIẾU NHẬP</td>
                        <div class="select">
                            <select name="MaPN" id="" class="select">
                                @foreach($phieunhap as $id=>$value)
                                <option>{{$value->MaPN}}</option>
                                @endforeach

                            </select>
                            @if($errors->has('MaPN'))
                            <span class="error-text">
                                {{$errors->first('MaPN')}}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <td> GIÁ TIỀN</td>
                        <input type="text" name="GiaTien" class="form-control">
                        @if($errors->has('GiaTien'))
                            <span class="error-text">
                                {{$errors->first('GiaTien')}}
                            </span>
                            @endif
                    </div>
                    <div class="form-group">
                        <td>SỐ LƯỢNG</td>
                        <input type="text" name="SoLuong" class="form-control">
                        @if($errors->has('SoLuong'))
                            <span class="error-text">
                                {{$errors->first('SoLuong')}}
                            </span>
                            @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4"> Lưu</button>
            </form>
        </div>
    </div>
</div>
