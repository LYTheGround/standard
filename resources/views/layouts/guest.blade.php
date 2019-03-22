<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title_page')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
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
    <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
</head>

<body>
<div class="main-wrapper">
    @include('layouts.navbar')
    <div class="account-page" style="padding-top:25px;">
        @yield('content')
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/translate.js') }}"></script>
</body>


<!-- Mirrored from dreamguys.co.in/preadmin/dark/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Apr 2018 15:10:04 GMT -->
</html>
