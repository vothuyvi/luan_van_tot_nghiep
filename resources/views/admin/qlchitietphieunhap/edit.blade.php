@extends('layout')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Sửa chi tiết phiếu nhập</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('phieunhap.index')}}" class="btn btn-primary float-end"> Danh các phiếu nhập</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('chitiet.update',$chitiet->MaChiTiet)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group1">
                            <td>MÃ SẢN PHẨM</td>
                            <div class="select">
                                <select name="MaSP" id="" class="select">
                                    @foreach($sanpham as $id=>$value)
                                    <option>{{$value->MaSP}}</option>
                                    @endforeach

                                </select>
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
                            </div>
                        </div>
                        <div class="form-group">
                            <td>GIÁ TIỀN</td>
                            <input type="text" name="GiaTien" value="{{$chitiet->GiaTien}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <td>SỐ LƯỢNG</td>
                            <input type="text" name="SoLuong" value="{{$chitiet->SoLuong}}" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
            </form>
        </div>
    </div>
</div>