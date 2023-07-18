@extends('menu')
<style>
    .container {
        padding-top: 70px;
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
                    <h5>Quản lý loại bình luận</h5>
                </div>
                <div id="notify_comment"></div>
                <!-- <div class="col-md-6">
                    <a href="" class="btn btn-primary float-end">Thêm loại</a>
                </div> -->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>NỘI DUNG</th>
                        <th>NGÀY BÌNH LUẬN</th>
                        <th>MÃ KHÁCH HÀNG</th>
                        <th>TÊN SẢN PHẨM</th>
                        <th>TRẠNG THÁI</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($binhluan as $id=>$value)
                    <tr>
                        <td>{{++$id}}</td>
                        <td>{{$value->NoiDung}}</td>
                        <td>{{$value->NgayBinhLuan}}</td>
                        <td>{{$value->MaKH}}</td>
                        <td>{{$value->products->TenSP}} </td>
                    <td col>
                            <!-- @if($value->Status==0)
                            <input type="button" value="HIỂN THỊ"  data-comment_status="1" data-comment_id="{{$value->MaBL}}" id="{{$value->MaSP}}" class="btn btn-primary btn-xs comment_status_btn">
                            @else
                            <input type="button" value="ẨN" data-comment-status="0" data-comment_id="{{$value->MaBL}}" id="{{$value->MaSP}}" class="btn btn-danger btn-xs comment_status_btn">

                            @endif -->
                            
                    </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
