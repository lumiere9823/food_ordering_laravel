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


    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <!--
    

    
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

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

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
            $('.status-toggle').change(function() {
                var categoryId = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '/category/change-status/' + categoryId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        var categoryStatus = $('#categoryStatus_' + categoryId);
                        categoryStatus.text(status == 1 ? 'active' : 'inactive');
                        showToast('Category status changed successfully!');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            $('#categoryForm').submit(function(e) {
                e.preventDefault(); // prevent default form submission
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        showToast('Category added successfully!');
                        form.trigger('reset'); // reset form fields
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            $('.update-category-form').submit(function(e) {
                e.preventDefault(); // prevent default form submission
                var form = $(this);
                var modal = form.closest('.modal');
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        showToast('Category updated successfully!');
                        modal.modal('hide'); // Hide the modal after successful update
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            //deliver boy
            $('.status-toggle-deli').change(function() {
                var deli_Id = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '/delivery-boy/change-status/' + deli_Id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status // Sử dụng tên biến là 'status' thay vì 'status1'
                    },
                    success: function(response) {
                        var deliveryBoyStatus_ = $('#deliveryBoyStatus_' + deli_Id);
                        deliveryBoyStatus_.text(status == 1 ? 'active' : 'inactive');
                        showToast('Delivery Boy Status changed successfully!');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('#deliveryBoyForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        showToast('Delivery Boy added successfully!');
                        form.trigger('reset');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            //coupon
            $('.status-toggle-coupon').change(function() {
                var coupon_Id = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '/coupon/change-status/' + coupon_Id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        var CouponStatus_ = $('#CouponStatus_' + coupon_Id);
                        CouponStatus_.text(status == 1 ? 'active' : 'inactive');
                        showToast('Coupon Status changed successfully!');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('#CouponForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        showToast('Coupon added successfully!');
                        form.trigger('reset');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            //dish
            $('.status-toggle-dish').change(function() {
                var dish_Id = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '/dish/change-status/' + dish_Id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        var dishStatus_ = $('#dishStatus_' + dish_Id);
                        dishStatus_.text(status == 1 ? 'active' : 'inactive');
                        showToast('Dish Status changed successfully!');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('#DishForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr(
                        'action'),
                    type: form.attr(
                        'method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        showToast('Dish added successfully!');
                        form.trigger('reset');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

        });

        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var categoryId = $(this).data('category-id');
                $('#categoryIdToDelete').val(categoryId);
            });

            $('#confirmDeleteBtn').click(function() {
                var categoryId = $('#categoryIdToDelete').val();
                $.ajax({
                    url: '/category/delete/' + categoryId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        showToast('Category deleted successfully!');
                        $('#confirmDeleteModal').modal('hide');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });



        function showToast(message) {
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "linear-gradient(to right, #ff7e5f, #feb47b)",
                className: 'toastify',
                stopOnFocus: true
            }).showToast();
        }
    </script>

</body>

</html>
