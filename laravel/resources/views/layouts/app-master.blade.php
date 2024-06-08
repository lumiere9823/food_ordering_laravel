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

    <script src="{!! url('bower_components/jquery/dist/jquery.min.js') !!}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

    <script src="{!! url('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <script src="{!! url('dist/js/adminlte.min.js') !!}"></script>

    <script src="{!! url('plugins/datatables/jquery.dataTables.js') !!}"></script>
    <script src="{!! url('plugins/datatables-bs4/js/dataTables.bootstrap4.js') !!}"></script>

    <script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        $(document).ready(function() {
            //toggle status
            $('.status-toggle-cate, .status-toggle-deli, .status-toggle-coupon, .status-toggle-dish').change(
                function() {
                    var id = $(this).data('id');
                    var passing_url = $(this).data('url');
                    var passing_code = $(this).data('code');
                    var status = $(this).is(':checked') ? 1 : 0;

                    $.ajax({
                        url: passing_url + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                        success: function(response) {
                            var status_text = $('#' + passing_code + id);
                            status_text.text(status == 1 ? 'active' : 'inactive');
                            showToast('Category status changed successfully!');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });

            //Created Form
            $('#categoryForm, #deliveryBoyForm, #CouponForm, #DishForm').submit(function(e) {
                e.preventDefault(); // prevent default form submission
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        showToast('Created successfully!');
                        form.trigger('reset'); // reset form fields
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            //Update Form
            $('.update-category-form, .update-dish-form, .update-deli-form, .update-coupon-form').submit(function(
                e) {
                e.preventDefault();
                var form = $(this);
                var modal = form.closest('.modal');
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        showToast('Updated successfully!');
                        modal.modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            //delete record
            $('.show_confirm').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                var order_id = $(this).attr('id').split('_')[1];
                Swal.fire({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                showToast('Record deleted successfully!');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
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

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
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
</body>
