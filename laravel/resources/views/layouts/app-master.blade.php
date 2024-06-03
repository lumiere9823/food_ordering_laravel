<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Admin DashBoard</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{!! url('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! url('bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! url('bower_components/Ionicons/css/ionicons.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! url('dist/css/AdminLTE.min.css') !!}">

    <link rel="stylesheet" href="{!! url('dist/css/skins/skin-blue.min.css') !!}">
    <link rel="stylesheet" href="{!! url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! url('plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>

    <!--     
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  Custom styles for this template 
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet"> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.partials.navbar')

        @include('layouts.partials.sidebar')

        @yield('title')

        @yield('content')

        @include('layouts.partials.footer')

        @include('layouts.partials.control-sidebar')
    </div>

    <!-- <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script> -->
    <script src="{!! url('bower_components/jquery/dist/jquery.min.js') !!}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{!! url('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <!-- AdminLTE App -->
    <script src="{!! url('dist/js/adminlte.min.js') !!}"></script>

    <script src="{!! url('plugins/datatables/jquery.dataTables.js') !!}"></script>
    <script src="{!! url('plugins/datatables-bs4/js/dataTables.bootstrap4.js') !!}"></script>

    <script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(function() {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delete-category').click(function() {
            var categoryId = $(this).data('id');

            // Xác nhận trước khi xóa
            if(confirm("Are you sure you want to delete this category?")) {
                $.ajax({
                    url: '/category/delete/' + categoryId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Xử lý phản hồi từ server (nếu cần)
                        console.log(response);
                        // Cập nhật giao diện người dùng (nếu cần)
                        location.reload(); // Ví dụ: làm mới trang sau khi xóa
                    },
                    error: function(xhr) {
                        // Xử lý lỗi (nếu có)
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        $('.change-status').click(function() {
            var categoryId = $(this).data('id');

            $.ajax({
                url: '/category/change-status/' + categoryId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Xử lý phản hồi từ server (nếu cần)
                    console.log(response);
                    // Cập nhật giao diện người dùng (nếu cần)
                    location.reload(); // Ví dụ: làm mới trang sau khi thay đổi trạng thái
                },
                error: function(xhr) {
                    // Xử lý lỗi (nếu có)
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>


</body>

</html>