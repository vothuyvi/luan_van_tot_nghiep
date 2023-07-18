@extends('menu')
<style>
    .container {
        padding-top: 70px;
    }
    .form{
        display: flex;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5>Quản lý loại tài khoản</h5>
                </div>
                <!-- <div class="col-md-6">
                    <a href="" class="btn btn-primary float-end">Thêm loại</a>
                </div> -->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                       <th>MÃ KHÁCH HÀNG</th>
                       <th>TÊN KHÁCH HÀNG</th>
                       <th>ĐỊA CHỈ</th>
                       <th>SỐ ĐIỆN THOẠI</th>
                       <th>HÌNH ẢNH</th>
                       <th>NGÀY SINH</th>
                       <th>EMAIL</th>

                    </tr>
                </thead>
                <tbody>

                @foreach($taikhoan as $id=>$value)
                    <tr>
                        <td>{{$value->MaKH}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->address}}</td>
                        <td>{{$value->phone}}</td>
                        <td>{{$value->hinhanh}}</td>
                        <td>{{$value->birthday}}</td>
                        <td>{{$value->email}}</td>

                    </tr>
                    @endforeach


                </tbody>
            </table>
            {{$taikhoan->links()}}
        </div>
    </div>
