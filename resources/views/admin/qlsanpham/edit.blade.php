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

.choice {
    display: flex;
}

.type {
    padding-top: 12px;
}

.KM {
    padding-top: 100px;
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
            <form action="{{route('sanpham.update',$sanpham->MaSP)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <td>TÊN SẢN PHẨM</td>
                            <input type="text" name="TenSP" value="{{$sanpham->TenSP}}" class="form-control">
                            @if($errors->has('TenSP'))
                            <span class="error-text">
                                {{$errors->first('TenSP')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>SỐ LƯỢNG</td>
                            <input type="text" name="SoLuong" value="{{$sanpham->SoLuong}}" readonly
                                class="form-control">
                            @if($errors->has('SoLuong'))
                            <span class="error-text">
                                {{$errors->first('SoLuong')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>MÔ TẢ</td>
                            <textarea name="MoTa" class="form-control">{{$sanpham->MoTa}}</textarea>
                            @if($errors->has('MoTa'))
                            <span class="error-text">
                                {{$errors->first('MoTa')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>GIÁ TIỀN</td>
                            <input type="text" name="GiaTien" value="{{$sanpham->GiaTien}}" class="form-control">
                            @if($errors->has('GiaTien'))
                            <span class="error-text">
                                {{$errors->first('GiaTien')}}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <td>KÍCH THƯỚC</td>
                            <input type="text" name="KichThuoc" value="{{$sanpham->KichThuoc}}" class="form-control">
                            @if($errors->has('KichThuoc'))
                            <span class="error-text">
                                {{$errors->first('KichThuoc')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>HÌNH ẢNH</td>
                            <input type="file" name='upload_file' class="form-control">
                            @if($errors->has('upload_file'))
                            <span class="error-text">
                                {{$errors->first('upload_file')}}
                            </span>
                            @endif
                        </div>
                        <div class="choice type">
                            <td>TÊN LOẠI:</td>
                            <div class="select">
                                <select name="MaLoai" id="" class="select">
                                    <option>{{$sanpham->loai->TenLoai}}</option>
                                    @foreach($loai as $id=>$value)
                                    @if($value->MaLoai == old('MaLoai') || $value->MaLoai == $sanpham->MaLoai)
                                    <option value="{{$value->MaLoai}}" selected>{{$value->TenLoai}}</option>
                                    @else
                                    <option value="{{$value->MaLoai}}">{{$value->TenLoai}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="choice KM">
                            <td>MÃ KHUYẾN MÃI:</td>
                            <div class="select">
                                <select name="MaKM" id="" class="select">
                                    @foreach($khuyenmai as $id=>$value)
                                    <option></option>
                                    <option>{{$value->MaKM}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
            </form>
        </div>
    </div>
</div>