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
                <h2>Sửa hình ảnh</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('hinhanh.index')}}" class="btn btn-primary float-end"> Danh các hình ảnh</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('hinhanh.update',$hinhanh->MaAnh)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
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
                            <td>MÃ SẢN PHẨM</td>
                            <select name="MaSP" id="" class="select">
                                @foreach($data as $id=>$value)
                                <option>{{$value->MaSP}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
            </form>
        </div>
    </div>
</div>