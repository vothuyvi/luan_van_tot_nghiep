@extends('layout')
<style>

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
                <h2>Sửa sản phẩm</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('sanpham.index')}}" class="btn btn-primary float-end"> Danh các gia vị</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('sanpham.update',$sanpham->MaSP)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <td>TÊN SẢN PHẨM</td>
                            <input type="text" name="TenSP" value="{{$sanpham->TenSP}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <td>SỐ LƯỢNG</td>
                            <input type="text" name="SoLuong" value="{{$sanpham->SoLuong}}"  readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <td>MÔ TẢ</td>
                            <textarea name="MoTa"  class="form-control">{{$sanpham->MoTa}}</textarea>
                        </div>
                        <div class="form-group">
                            <td>GIÁ TIỀN</td>
                            <input type="text" name="GiaTien" value="{{$sanpham->GiaTien}}"  class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <td>KÍCH THƯỚC</td>
                            <input type="text" name="KichThuoc" value="{{$sanpham->KichThuoc}}"  class="form-control">
                        </div>
                        <div class="form-group1">
                            <td>MÃ LOẠI:</td>
                            <div class="select">
                                <select name="MaLoai" id="" class="select">
                                    @foreach($loai as $id=>$value)
                                    <option>{{$value->MaLoai}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group1">
                            <td>MÃ KHUYẾN MÃI:</td>
                            <div class="select">
                                <select name="MaKM" id="" class="select">
                                    @foreach($khuyenmai as $id=>$value)
                                    <option>{{$value->MaKM}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group1">
                            <td>MÃ BÌNH LUẬN:</td>
                            <div class="select">
                                <select name="MaKM" id="" class="select">
                                    
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
            </form>
        </div>
    </div>
</div>

