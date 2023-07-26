@extends('layout')

<script src="ckeditor/ckeditor.js"></script>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Thêm tin tức</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('tintuc.index')}}" class="btn btn-primary float-end">Tin tức</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('tintuc.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <td>TIÊU ĐỀ</td>
                        <textarea placeholder="Nhập tiêu đề" name="TieuDe" class="form-control"></textarea>
                        @if($errors->has('TieuDe'))
                        <span class="error-text">
                            {{$errors->first('TieuDe')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>NỘI DUNG</td>
                        <textarea placeholder="Nhập nội dung tin tức" name="NoiDung" class="form-control"
                            id="editor"></textarea>
                        @if($errors->has('NoiDung'))
                        <span class="error-text">
                            {{$errors->first('NoiDung')}}
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
                    <div class="form-group">
                        <td>NGÀY ĐĂNG</td>
                        <input type="date" name="NgayDang" class="form-control">
                        @if($errors->has('NgayDang'))
                        <span class="error-text">
                            {{$errors->first('NgayDang')}}
                        </span>
                        @endif
                    </div>

                </div>
                <button type="submit" class="btn btn-success mt-4"> Lưu</button>
            </form>
        </div>
    </div>
</div>