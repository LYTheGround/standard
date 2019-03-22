@extends('layouts.guest')
@section('title_page')
    {{ __("auth/login.login") }}
@stop
@section('content')
    <div class="container">
        <h3 class="account-title">{{ __("auth/login.login") }}</h3>
        <div class="account-box">
            @if (session()->has('danger'))
                <div class="alert alert-danger" role="alert">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="account-wrapper">
                <div class="account-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo_.png') }}" alt="Preadmin">
                    </a>
                </div>
                {{ Form::open(['method'=>'POST','url'=>route('login')]) }}
                <div class="form-group">
                    <div class="form-focus">
                        {{ Form::label('login',__('validation.attributes.username'),['class'=>'control-label']) }}
                        {{ Form::text('login',null,['class'=> 'form-control floating','required','maxlength'=>'50','minlength' => '3']) }}
                    </div>
                    @if($errors->has('login'))
                        <span class="text-danger">{{ $errors->first('login') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="form-focus">
                        {{ Form::label('password',__('validation.attributes.password'),['class'=>'control-label']) }}
                        {{ Form::password('password',['class'=>'form-control floating','required']) }}
                    </div>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block account-btn"
                            type="submit">{{ __("auth/login.login") }}</button>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}">{{ __("auth/login.I don't have an account yet") }}</a>
                </div>

                <div class="text-center">
                    <a href="{{ route('password.request') }}">{{ __('auth/login.Forgot your password') }}</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
