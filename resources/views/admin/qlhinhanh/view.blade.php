@extends('menu')
<style>
.container {
    padding-top: 70px;
}

.form {
    display: flex;
}

.table {
    text-align: center;
}

.img {
    width: 85px;
    height: 80px;
    object-fit: cover;
}
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
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
                <div class="col-md-6">
                    <h5> Quản lý hình ảnh của sản phẩm</h5>
                </div>
                <div class="col-md-6">
                    <a href="{{route('hinhanh.create')}}" class="btn btn-primary float-end">Thêm hình ảnh</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>HÌNH ẢNH</th>
                        <th>SẢN PHẨM</th>
                        <th>THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $currentPage = Request::get('page') ? Request::get('page') - 1 : 0;
                    @endphp
                    @foreach($data as $id=>$value)
                    <tr>
                        <td>{{++$id+($currentPage*5)}}</td>
                        <td>
                            <img src="{{ asset('public/images/products/' .$value->HinhAnh)}}" alt="" class="img
                            ">
                        </td>
                        <td>{{$value->MaSP}}</td>
                        <td col>

                            <a href="{{route('hinhanh.edit',$value->MaAnh)}}" class="btn btn-info"><i
                                    class='bx bx-pen nav_icon'></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class='bx bx-x nav_icon'></i></button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$data->links()}}
        </div>
    </div>