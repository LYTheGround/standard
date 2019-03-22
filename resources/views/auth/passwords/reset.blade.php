@extends('layouts.guest')

@section('title_page')
    {{ ucfirst(__('auth/pswr.reset_title')) }}
@stop
@section('content')
    <div class="container">
        <h3 class="account-title">{{ ucfirst(__('auth/pswr.reset_title')) }}</h3>
        <div class="account-box">
            <div class="account-wrapper">
                <div class="account-logo">
                    <p>{{ __('auth/pswr.reset_text') }}</p>
                </div>
                {{ Form::open(['method'=>'POST','url'=>route('password.update')  ]) }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group row">
                    <div class="form-focus">
                        {{ Form::label('email',__('validation.attributes.email'),['class'=>'control-label']) }}
                        {{ Form::email('email',null,['class'=> 'form-control floating','required','maxlength'=>'50','minlength' => '3']) }}
                    </div>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="form-focus">
                        {{ Form::label('password',__('validation.attributes.password'),['class'=>'control-label']) }}
                        {{ Form::password('password',['class' => 'form-control', 'placeholder' => __('validation.attributes.password'),'required','minlenght' => '6','maxlenght' => '80']) }}

                    </div>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="form-focus">
                        {{ Form::label('password_confirmation',__('validation.attributes.password_confirmation'),['class'=>'control-label']) }}
                        {{ Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => __('validation.attributes.password_confirmation'),'required','minlenght' => '6','maxlenght' => '80']) }}

                    </div>
                    @if($errors->has('password_confirmation'))
                        <span
                                class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>


                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block account-btn"
                            type="submit">{{ ucfirst(__('auth/pswr.reset_title')) }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
