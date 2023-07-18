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
                <h2>Thêm sản phẩm</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('sanpham.index')}}" class="btn btn-primary float-end"> Danh các sản phẩm</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('sanpham.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <td>MÃ SẢN PHẨM</td>
                            <input type="text" name="MaSP" class="form-control">
                        </div>
                        <div class="form-group">
                            <td>TÊN SẢN PHẨM</td>
                            <input type="text" name="TenSP" class="form-control">
                        </div>
                        <div class="form-group">
                            <td>SỐ LƯỢNG</td>
                            <input type="text" name="SoLuong" class="form-control">
                        </div>
                        <div class="form-group">
                            <td>NGÀY THÊM</td>
                            <input type="date" name="NgayThem" class="form-control">
                        </div>
                        <div class="form-group">
                            <td>MÔ TẢ</td>
                            <textarea name="MoTa" id="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <td>GIÁ TIỀN</td>
                            <input type="text" name="GiaTien" class="form-control">
                        </div>
                        <div class="form-group">
                            <td>KÍCH THƯỚC</td>
                            <input type="text" name="KichThuoc" class="form-control">
                        </div>


                    </div>

                    <div class="col-md-6">

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
                            <td>MÃ KM:</td>
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
                                <select name="MaBinhLuan" id="" class="select">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <td><a href="{{route('sanpham.index')}}" class="">Thêm ảnh</a></td>
                        </div>
                    </div>


                </div>

                <button type="submit" class="btn btn-success mt-4"> Lưu</button>
            </form>
        </div>
    </div>
</div>
