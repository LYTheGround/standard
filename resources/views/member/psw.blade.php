@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('validation.attributes.password')) }}
@stop
@section('content')
    <div class="content container-fluid">
        {{ Form::open(['route' => 'member.psw']) }}
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        @include('form.password',[
                            'title'     => __('validation.attributes.old_password'),
                            'name'      => 'old_password',
                            'attributes' => ['required']
                            ])
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-6">
                        @include('form.password',[
                            'title'     => __('validation.attributes.password'),
                            'name'      => 'password',
                            'attributes' => ['required']
                            ])
                    </div>
                    <div class="col-xs-6">
                        @include('form.password',[
                            'title'     => __('validation.attributes.password_confirmation'),
                            'name'      => 'password_confirmation',
                            'attributes' => ['required']
                            ])
                    </div>

                </div>
                <div class="col-xs-12 text-right">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{ __('rh/member.update_psw') }}</button>
                    </div>
                </div>
            </div>

        </div>
        {{ Form::close() }}
    </div>
@stop