@extends('layout')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Sửa phiếu nhập</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('phieunhap.index')}}" class="btn btn-primary float-end"> Danh các phiếu nhập</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('phieunhap.update',$phieunhap->MaPN)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">

                        <div class="form-group">
                            <td>NGÀY NHẬP</td>
                            <input type="date" name="NgayNhap" value="{{$phieunhap->NgayNhap}}" class="form-control">
                            @if($errors->has('NgayNhap'))
                            <span class="error-text">
                                {{$errors->first('NgayNhap')}}
                            </span>
                            @endif
                        </div>

                </div>
                <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
            </form>
        </div>
    </div>
</div>

