<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>

    <title>@yield('page-title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    @if(\Illuminate\Support\Facades\App::isLocale('ar'))
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/bootstrap.rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/fullcalendar.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/morris/morris.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl/style.css') }}">

    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/bootstrap.rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/fullcalendar.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/morris/morris.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/ltr/style.css') }}">
        @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
</head>
<body>
<div class="main-wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <div class="page-wrapper">
        @if (session('status'))
            <div class="alert alert-success col-xs-10 col-xs-offset-1 m-t-10" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger col-xs-10 col-xs-offset-1 m-t-10" role="alert">
                {{ session('danger') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

<div class="sidebar-overlay" data-reff=""></div>
<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/translate.js') }}"></script>

</body>
</html>
