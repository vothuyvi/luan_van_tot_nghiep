@extends('menu')
<style>
    .container {
        padding-top: 70px;
    }

    .form {
        display: flex;
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
                    <h5> Quản lý sản phẩm</h5>
                </div>
                <div class="col-md-6">
                    <a href="{{route('sanpham.create')}}" class="btn btn-primary float-end">Thêm sản phẩm</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered " id="myTable">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>MÃ SẢN PHẨM</th>
                        <th>TÊN SẢN PHẨM</th>
                        <th>SỐ LƯỢNG</th>
                        <!-- <th>MÔ TẢ</th> -->
                        <th>KÍCH THƯỚC</th>
                        <th>LOẠI</th>
                        <!-- <th>MÃ KHUYẾN MÃI</th> -->
                        <th>THAO TÁC</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $id=>$value)
                    <tr>
                        <td>{{++$id}}</td>
                        <td>{{$value->MaSP}}</td>
                        <td>{{$value->TenSP}}</td>
                        <td>{{$value->SoLuong}}

                        </td>
                        <!-- <td>{{$value->MoTa}}</td> -->
                        <td>{{$value->KichThuoc}}</td>
                        <td>{{$value->loai->TenLoai}}</td>
                        <!-- <td>{{$value->MaKM}}</td> -->


                        <td col>
                            <form action="{{route('sanpham.destroy',$value->MaSP)}}" method="post" class="form">
                                <a href="{{route('sanpham.edit',$value->MaSP)}}" class="btn btn-info"><i class='bx bx-pen nav_icon'></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class='bx bx-x nav_icon'></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$data->links()}}
        </div>
    </div>
