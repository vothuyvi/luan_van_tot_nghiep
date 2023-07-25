@extends('menu')
<style>
.container {
    padding-top: 70px;
}

.table {
    text-align: center;
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
                <form action="" class="form-inline">

                    <div class="form-group">
                        <input class="form-control" name="key" placeholder="Tìm kiếm tại đây">
                    </div>
                    <button type="submit" class="btn btn-primary  search">
                        <i class='bx bx-search nav_icon'></i>
                    </button>
                </form>

                <div class="col-md-6">
                    <h5>Quản lý phiếu nhập</h5>
                </div>
                <div class="col-md-6">
                    <a href="{{route('phieunhap.create')}}" class="btn btn-primary float-end">TẠO PHIẾU NHẬP</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>MÃ PHIẾU NHẬP</th>
                        <th>NGÀY TẠO</th>
                        <th>THAO TÁC</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($phieunhap as $id=>$value)
                    <tr>
                        <td>{{++$id}}</td>
                        <td>{{$value->MaPN}}</td>
                        <td>{{$value->NgayNhap}}</td>
                        <td col>
                            <form action="" method="post" class="form">
                                <a href="{{route('phieunhap.edit',$value->MaPN)}}" class="btn btn-info"><i
                                        class='bx bx-pen nav_icon'></i></a>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{$phieunhap->appends(request()->all())->links()}}
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5>Chi tiết phiếu nhập của tất cả các sản phẩm</h5>
                </div>
                <div class="col-md-6">
                    <a href="{{route('chitiet.create')}}" class="btn btn-primary float-end">TẠO CHI TIẾT PHIẾU NHẬP</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>MÃ PHIẾU NHẬP</th>
                        <th>MÃ SẢN PHẨM</th>
                        <th>GIÁ TIỀN</th>
                        <th>SỐ LƯỢNG</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($chitiet as $id=>$value)
                    <tr>
                        <td>{{$value->MaPN}}</td>
                        <td>{{$value->MaSP}}</td>
                        <td>{{$value->GiaTien}}</td>
                        <td>{{$value->SoLuong}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{$chitiet->appends(request()->all())->links()}}
        </div>
    </div>
</div>