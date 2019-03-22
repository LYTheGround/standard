@extends('layouts.guest')

@section('title_page')
    {{ __('auth/pswr.title') }}
@stop
@section('content')

    <div class="container">
        <h3 class="account-title">{{ __('auth/pswr.title') }}</h3>
        <div class="account-box">
            <div class="account-wrapper">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="account-logo">
                    <p>{{ __('auth/pswr.email_text') }}</p>
                </div>
                {{ Form::open(['method'=>'POST','url'=>route('password.email') ]) }}
                <div class="form-group">
                    <div class="form-focus">
                        {{ Form::label('email',__('validation.attributes.email'),['class'=>'control-label']) }}
                        {{ Form::email('email',null,['class'=> 'form-control floating','required','maxlength'=>'80','minlength' => '3']) }}
                    </div>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block account-btn" type="submit">{{ __('auth/pswr.send') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
