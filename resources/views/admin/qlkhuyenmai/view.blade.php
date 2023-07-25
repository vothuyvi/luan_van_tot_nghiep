@extends('menu')
<style>
    .container {
        padding-top: 70px;
    }

    .container {
        padding-top: 70px;
    }

    .form {
        display: flex;
    }
    .form-inline{
    display: flex;
}
.search {
height: 100%;
}
.btn{
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

                <form action=""  class="form-inline">

                <div class="form-group">
                    <input class="form-control" name="key" placeholder="Tìm kiếm tại đây">
                </div>
                <button type="submit" class="btn btn-primary  search">
                <i class='bx bx-search nav_icon'></i>
                </button>
            </form>

                <div class="col-md-6">
                    <h5>Quản lý khuyến mãi</h5>
                </div>

                <div class="col-md-6">
                    <a href="{{route('khuyenmai.create')}}" class="btn btn-primary float-end">Tạo khuyến mãi</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>MÃ KHUYẾN MÃI</th>
                        <th>TÊN KHUYẾN MÃI</th>
                        <th>PHẦN TRĂM</th>
                        <th>NGÀY BẮT ĐẦU</th>
                        <th>NGÀY KẾT THÚC</th>
                        <th>TRẠNG THÁI</th>
                        <th>THAO TÁC</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($khuyenmai as $id=>$value)
                    <tr>
                        <td>{{$value->MaKM}}</td>
                        <td>{{$value->TenKM}}</td>
                        <td>{{$value->PhanTram}}</td>
                        <td>{{$value->NgayBatDau}}</td>
                        <td>{{$value->NgayKetThuc}}</td>
                        <td>{{$value->TrangThai}}</td>

                        <td col>
                            <!-- <form action="{{route('khuyenmai.destroy',$value->MaKM)}}" method="post"class="form"> -->
                            <a href="{{route('khuyenmai.edit',$value->MaKM)}}" class="btn btn-info"><i class='bx bx-pen nav_icon'></i></a>
                            @csrf
                            @method('DELETE')
                            <a type="submit" href="{{route('khuyenmai.destroy',$value->MaKM)}}" class="btn btn-danger btndelete"><i class='bx bx-x nav_icon'></i></a>
                            <!-- </form> -->
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{$khuyenmai->appends(request()->all())->links()}}
            <form action="" method="post" id="form-delete">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
    @section('js')
    <script>
        $('.btndelete').click(function(ev) {
            ev.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action', _href);
            if (confirm('Bạn có chắc chắn xóa không ?')) {
                $('form#form-delete').submit();
            }
            // alert(_href);
        })
    </script>
    @stop()
