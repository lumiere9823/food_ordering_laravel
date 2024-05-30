<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Fixed top navbar example Â· Bootstrap v5.1</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{!! url('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! url('bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! url('bower_components/Ionicons/css/ionicons.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! url('dist/css/AdminLTE.min.css') !!}">

    <link rel="stylesheet" href="{!! url('dist/css/skins/skin-blue.min.css') !!}">

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
      
  </body>
</html>