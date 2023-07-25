@extends('layout')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row-md-6">
                <h2>Thay đổi mật khẩu</h2>
            </div>
            <div class="col-md-6">
            </div>
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{Session::get('error')}}
                </div>
                @endif

                @if(Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{Session::get('success')}}
                </div>
                @endif
        </div>
        <div class="card-body">
            <form action="{{route('editpass.update', adminUser()->Ma)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                       
                        <div class="form-group">
                            <td>Mật khẩu mới:</td>
                            <input type="text" name="password" value="" class="form-control">
                            @if($errors->has('password'))
                            <span class="error-text">
                                {{$errors->first('password')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <td>Nhập lại mật khẩu mới</td>
                            <input type="text" name="password_comfirm" class="form-control">
                            @if($errors->has('password_comfirm'))
                            <span class="error-text">
                                {{$errors->first('password_comfirm')}}
                            </span>
                            @endif
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Cập nhập</button>
            </form>
        </div>
    </div>
</div>

