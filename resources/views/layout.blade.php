<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANG QUẢN TRỊ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


    <meta name="csrf-token" content="{{ csrf_token() }}">

       <style>
        .error-text{
        color: red;
        font-weight: bold;

    }

    .form-group text{
        color: black;
        font-weight: bold;
    }
    .error-text1{
        color:blue;
        font-weight:bold;
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
</head>

<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script src="../../public/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('ckeditor');
</script> -->
    <!-- Nhúng ckediter-->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <!-- ckediter-->
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- định dạng ngày -->
    <!-- biểu đồ-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    @yield('js')
    <!-- ajax quản lý bình luận-->
    <script>
        $('.comment_status_btn').click(function() {
            var comment_status = $(this).data('comment_status');
            var comment_MaBL = $(this).data('comment_id');
            var comment_MaSP = $(this).attr('id');

            // alert(comment_status);
            // alert(comment_MaBL);
            // alert(comment_MaSP);


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/binhluan')}}",
                data: {
                    comment_status: comment_status,
                    comment_MaBL: comment_MaBL,
                    comment_MaSP: comment_MaSP,
                },
                method: 'POST',
                success: function(data) {
                    $('#notify_comment').html('<span class="text text-alert">'+"Thay đổi trạng thái thành công"+'</span>');
                    location.reload();
                }
            });

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</body>

</html>
