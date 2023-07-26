@extends('layout')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Sửa tin tức</h2>
            </div>
            <div class="col-md-6">
                <a href="{{route('tintuc.index')}}" class="btn btn-primary float-end"> Danh các tin tức</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('tintuc.update',$tintuc->MaTT)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group">
                        <td>TIÊU ĐỀ</td>
                        <input type="text" name="TieuDe" value="{{$tintuc->TieuDe}}" class="form-control">
                        @if($errors->has('TieuDe'))
                        <span class="error-text">
                            {{$errors->first('TieuDe')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <td>NỘI DUNG</td>
                        <textarea type="numnber" name="NoiDung" class="form-control"
                            id="editor">{{$tintuc->NoiDung}}</textarea>
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
                        <input type="date" name="NgayDang" value="{{$tintuc->NgayDang}}" class="form-control">
                        @if($errors->has('NgayDang'))
                        <span class="error-text">
                            {{$errors->first('NgayDang')}}
                        </span>
                        @endif
                    </div>

                </div>
        </div>
        <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
        </form>
    </div>
</div>