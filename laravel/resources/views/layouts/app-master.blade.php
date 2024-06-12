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
        $('#categoryForm, #deliveryBoyForm, #CouponForm, #DishForm, #roleForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    showToast('Created successfully!');
                    form.trigger('reset');
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
                url: form.attr('action'), // Get the form action URL
                type: form.attr('method'), // Get the form submission method (POST, GET, etc.)
                data: formData, // Use FormData object for data
                processData: false, // Prevent jQuery from processing data
                contentType: false, // Prevent jQuery from setting contentType
                success: function(response) {
                    showToast('Dish created successfully!'); // Show success message
                    form.trigger('reset'); // Reset form fields
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Log error message
                }
            });
        });


        //Update Form
        $('.update-category-form,  .update-deli-form, .update-coupon-form, .update-role-form').submit(function(
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

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
body,
.toggle-container,
.followers,
.followers-card,
.followers-card_user,
.fallowers-today-number,
.overview-today_card_header,
.overview-today,
.overview-today_card_main {
  display: flex;
}


html,
body,
.followers-card {
  flex-direction: column;
}

html,
body {
  min-height: 100vh;
  background-color: var(--bg);
}

    :root {
        --bg: hsl(230, 17%, 14%);
        --bg-top: hsl(232, 19%, 15%);
        --bg-card: hsl(228, 28%, 20%);

        --text: hsl(228, 34%, 66%);
        --text-secondary: hsl(0, 0%, 100%);

        --input-bg: linear-gradient(to right, hsl(210, 78%, 56%), hsl(146, 68%, 55%));

        --font-weight-normal: 400;
        --font-weight-bold: 700;

        --border-top-card: hsl(228, 34%, 66%);

        --lime-green: hsl(163, 72%, 41%);
        --bright-red: hsl(356, 69%, 56%);

        font-size: 14px;
        font-family: "Inter", sans-serif;
    }

    .light {
        --bg: hsl(0, 0%, 100%);
        --bg-top: hsl(225, 100%, 98%);
        --bg-card: hsl(227, 47%, 96%);

        --input-bg: hsl(230, 22%, 74%);

        --text: hsl(228, 12%, 44%);
        --text-secondary: hsl(230, 17%, 14%);
    }

    .facebook {
        --border-top-card: hsl(195, 100%, 50%);
    }

    .twitter {
        --border-top-card: hsl(203, 89%, 53%);
    }

    .youtube {
        --border-top-card: hsl(348, 97%, 39%);
    }

    .instagram {
        --border-top-card: linear-gradient(to right,
                hsl(37, 97%, 70%),
                hsl(329, 70%, 58%));
    }

    .positive {
        color: var(--lime-green);
    }

    .negative {
        color: var(--bright-red);
    }

    main {
        margin: 1.5rem;
    }



    .toggle-container,
    .overview-today_card_header,
    .overview-today_card_main {
        justify-content: space-between;
    }

    .toggle-container {
        gap: 12px;
    }

    #dark {
        appearance: none;
        position: relative;
        padding: 2.5px;

        width: 50px;
        height: 25px;

        background: var(--input-bg);
        border-radius: 1000px;
        transition: 0.3s ease-in-out;
    }

    #dark::before {
        content: "";
        display: block;
        width: 20px;
        height: 20px;
        background: var(--bg-card);
        border-radius: 50%;
        transition: 0.3s;
    }

    #dark:checked::before {
        transform: translateX(25px);
    }

    .followers {
        margin-bottom: 2rem;
        gap: 24px;
        flex-wrap: wrap;
    }

    .followers-card {
        padding: 2rem;
        width: 300px;
        color: white;
        background-color: var(--bg-card);
        border-radius: 6px;
        flex: 1 1 282px;
        gap: 1rem;
        overflow: hidden;
        position: relative;
        animation-name: start;
        animation-duration: 1s;
    }

    .followers-card_border {
        position: absolute;
        top: 0;
        left: 0;
        height: 6px;
        background: var(--border-top-card);
        width: 100%;
    }

    .followers-card_user {
        gap: 8px;
    }

    .followers-number {
        text-align: center;
    }

    .followers-number_text {
        text-transform: uppercase;
        letter-spacing: 0.5rem;
    }

    .fallowers-today-number {
        text-align: center;
        gap: 6px;
    }

    .followers-number_value {
        font-size: 5rem;
    }

    .followers-today-number_text {
        font-weight: var(--font-weight-bold);
    }

    .overview-today {
        margin-top: 1.5rem;
        flex-wrap: wrap;
        gap: 24px;
    }

    .overview-today_card {
        padding: 2rem;
        background-color: var(--bg-card);
        border-radius: 5px;
        flex: 1 1 282px;
        animation-name: start;
        animation-duration: 1s;
    }

    .overview-today_card_header {
        padding-bottom: 1rem;
        margin-bottom: 0.5rem;
    }

    .overview-today_card_main_number {
        font-size: 2.5rem;
    }

    .overview-today_card_main {
        align-items: flex-end;
    }

    @media (min-width: 875px) {
        header {
            justify-content: space-between;
            align-items: center;
        }

        .title-container {
            border: none;
            padding: 0;
            margin: 0;
        }
    }

    @keyframes start {
        from {
            transform: translate(50%);
        }
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