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
    padding-top: 20px;
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
                            <input type="text" name="MaSP" value="{{old('MaSP')}}" class="form-control">
                            @if($errors->has('MaSP'))
                            <span class="error-text">
                                {{$errors->first('MaSP')}}
                            </span>
                            @endif

                        </div>
                        <div class="form-group">
                            <td>TÊN SẢN PHẨM</td>
                            <input type="text" name="TenSP" value="{{old('TenSP')}}" class="form-control">
                            @if($errors->has('TenSP'))
                            <span class="error-text">
                                {{$errors->first('TenSP')}}
                            </span>
                            @endif
                        </div>
                        <!-- <div class="form-group">
                            <td>SỐ LƯỢNG</td>
                            <input type="text" name="SoLuong" id="SoLuong" class="form-control">

                            @if($errors->has('SoLuong'))
                            <span class="error-text">
                                {{$errors->first('SoLuong')}}
                            </span>
                            @endif
                        </div> -->
                        <div class="form-group">
                            <td>NGÀY THÊM</td>
                            <input type="date" name="NgayThem" value="{{old('NgayThem')}}" class="form-control">
                            @if($errors->has('NgayThem'))
                            <span class="error-text">
                                {{$errors->first('NgayThem')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>MÔ TẢ</td>
                            <textarea name="MoTa" id="" value="{{old('MoTa')}}" class="form-control"></textarea>
                            @if($errors->has('MoTa'))
                            <span class="error-text">
                                {{$errors->first('MoTa')}}
                            </span>
                            @endif
                        </div>



                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <td>HÌNH ẢNH</td>
                            <input type="file" name='upload_file' class="form-control">
                            @if($errors->has('upload_file'))
                            <span class="error-text">
                                {{$errors->first('upload_file')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>GIÁ TIỀN</td>
                            <input type="text" name="GiaTien" value="{{old('GiaTien')}}" class="form-control">
                            @if($errors->has('GiaTien'))
                            <span class="error-text">
                                {{$errors->first('GiaTien')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>KÍCH THƯỚC</td>
                            <input type="text" name="KichThuoc" value="{{old('KichThuoc')}}" class="form-control">
                            @if($errors->has('KichThuoc'))
                            <span class="error-text">
                                {{$errors->first('KichThuoc')}}
                            </span>
                            @endif
                        </div>
                            <div class="choice type">
                                <td>TÊN LOẠI:</td>
                                <select name="MaLoai" id="" class="select">
                                    <option></option>
                                    @foreach($loai as $id=>$value)
                                    @if($value->MaLoai == old('MaLoai'))
                                    <option value="{{$value->MaLoai}}" selected>{{$value->TenLoai}}</option>
                                    @else
                                    <option value="{{$value->MaLoai}}">{{$value->TenLoai}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if($errors->has('MaLoai'))
                                <span class="error-text">
                                    {{$errors->first('MaLoai')}}
                                </span>
                                @endif
                            </div>

                        <!-- <div class="form-group1">
                            <td>MÃ KM:</td>
                            <div class="select">
                                <select name="MaKM" id="" class="select">
                                    <option></option>
                                    @foreach($khuyenmai as $id=>$value)
                                    <option>{{$value->MaKM}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->

                    </div>


                </div>

                <button onclick="check()" value="check" type="submit" class="btn btn-success mt-4"> Lưu</button>

            </form>
        </div>
    </div>
</div>
