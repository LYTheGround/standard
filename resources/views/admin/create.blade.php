@extends('layouts.admin.admin')
@section('page-title')
    {{ __('admin/admin.create') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4>{{ __('admin/admin.create') }}</h4>
            </div>
        </div>
        <div class="card-box">
            {{ Form::open(['method' => 'POST', 'url' => route('admin.store') ]) }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('email',ucfirst(__("validation.attributes.email")),['class' => 'control-label']) }}
                            {{ Form::email('email',null,['class' => 'form-control form-floating','required', 'autofocus']) }}
                        </div>
                        @if($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('login', ucfirst(__('validation.attributes.username')),['class' => 'control-label']) }}
                            {{ Form::text('login',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('login'))
                            <span class="text-danger">
                                {{ $errors->first('login') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('city',ucfirst(__("validation.attributes.city")),['class' => 'control-label']) }}
                            <select name="city" id="city" title="city" class="form-control form-floating">
                                <option disabled selected value></option>
                                @foreach(\App\City::all() as $city)
                                    <option value="{{ $city->id }}"
                                            {{ (old('city') == $city->id) ? 'selected' : '' }}>{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('city'))
                            <span class="text-danger">
                                {{ $errors->first('city') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('tel',ucfirst(__('validation.attributes.mobile')),['class' => 'control-label']) }}
                            {{ Form::text('tel', null,['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('tel'))
                            <span class="text-danger">
                                {{ $errors->first('tel') }}
                            </span>
                        @endif
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('password',ucfirst(__("validation.attributes.password")),['class' => 'control-label']) }}
                            {{ Form::password('password',['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('password'))
                            <span class="text-danger">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('password_confirmation',ucfirst(__("validation.attributes.password_confirmation")),['class' => 'control-label']) }}
                            {{ Form::password('password_confirmation',['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('password_confirmation'))
                            <span class="text-danger">
                                {{ $errors->first('password_confirmation') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ ucfirst(__('admin/admin.create')) }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
