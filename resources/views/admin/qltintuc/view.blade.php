@extends('menu')
<style>
    .container{ padding-top: 70px;}
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
                    <h5>Quản lý tin tức</h5>
                </div>
                <div class="col-md-6">
                    <a href="{{route('tintuc.create')}}" class="btn btn-primary float-end">Thêm tin tức</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                       <th>MaTT</th>
                       <!-- <th>NỘI DUNG</th> -->
                       <th>NGÀY ĐĂNG</th>
                       <th>THAO TÁC</th>

                    </tr>
                </thead>
                <tbody>

                @foreach($Tintuc as $id=>$value)
                    <tr>
                        <td>{{$value->MaTT}}</td>
                        <!-- <td>{{$value->NoiDung}}</td> -->
                        <td>{{$value->NgayDang}}</td>




                        <td col>
                            <!-- <form action="{{route('tintuc.destroy',$value->MaTT)}}" method="post" class="form"> -->
                            <a href="" class="btn btn-info"><i class='bx bx-pen nav_icon'></i></a>
                            @csrf
                            @method('DELETE')
                            <a type="submit" href="{{route('tintuc.destroy',$value->MaTT)}}"  class="btn btn-danger btndelete"><i class='bx bx-x nav_icon'></i></a>
                            <!-- </form> -->
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <form action="" method="post" id="form-delete">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
    @section('js')
    <script>
        $('.btndelete').click(function(ev){
            ev.preventDefault();
            var  _href=$(this).attr('href');
            $('form#form-delete').attr('action',_href);
            if(confirm('Bạn có chắc chắn xóa không ?'))
            {
                $('form#form-delete').submit();
            }
            // alert(_href);
        })
    </script>
    @stop()
