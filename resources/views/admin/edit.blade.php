@extends('layouts.admin.admin')
@section('page-title')
    {{ __('admin/admin.update') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>{{ auth()->user()->login }}</h1>
            </div>
        </div>
        <div class="card-box">
            {{ Form::model(auth()->user(),['method' => 'PUT', 'url' => route('admin.params.update') ]) }}
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
                                @foreach(\App\City::all() as $city)
                                    <option value="{{ $city->id }}"
                                            @if(old('city') === $city->id)
                                            selected
                                            @elseif(auth()->user()->admin->city_id === $city->id)
                                            selected
                                            @endif
                                    >{{ $city->city }}</option>
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
                            {{ Form::label('tel',ucfirst(__('validation.attributes.phone')),['class' => 'control-label']) }}
                            {{ Form::text('tel', auth()->user()->admin->tel,['class' => 'form-control form-floating']) }}
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
                        <i class="fa fa-edit"></i> {{ ucfirst(__('admin/admin.update')) }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
