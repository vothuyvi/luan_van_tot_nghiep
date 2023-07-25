@extends('menu')
<style>
.container {
    padding-top: 70px;
}

.form {
    display: flex;
}

.page {
    padding-top: 12px;
}

.form-inline {
    display: flex;
}

.search {
    height: 100%;
}

.btn {
    padding-left: 12px;
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
                <!-- tìm kiếm-->
                <form action="" class="form-inline">

                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="Tìm kiếm tại đây">
                    </div>
                    <button type="submit" class="btn btn-primary  search">
                        <i class='bx bx-search nav_icon'></i>
                    </button>
                </form>
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
                    @php
                    $currentPage = Request::get('page') ? Request::get('page') - 1 : 0;
                    @endphp
                    @foreach($data as $id=>$value)
                    <tr>
                        <td>{{++$id+($currentPage*7)}}</td>
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
                                <a href="{{route('sanpham.edit',$value->MaSP)}}" class="btn btn-info"><i
                                        class='bx bx-pen nav_icon'></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class='bx bx-x nav_icon'></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <table>
                <div class="form-group ">
                    <td><a href="{{route('hinhanh.index')}}" class="btn btn-primary mt-4">Thêm nhiều ảnh</a>
                    </td>
                </div>
            </table>
            <div class="page">
                {{$data->appends(request()->all())->links()}}

            </div>
        </div>
    </div>