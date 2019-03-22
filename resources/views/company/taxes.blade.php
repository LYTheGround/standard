@extends('layouts.admin.admin')
@section('page-title')
    {{ __('validation.attributes.taxes') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row card-box">
            {{ Form::model($company->info_box,['method' => 'PUT', 'url' => route('taxes.update',compact('company'))]) }}
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        {{ Form::label('taxes',__('validation.attributes.taxes') . ' :',['class' => 'control-label']) }}
                        {{ Form::number('taxes',null,['class'=> 'form-control','placeholder' => __('validation.attributes.taxes'), 'required']) }}
                    </div>
                    @if($errors->has('taxes'))
                        <span class="text-danger">{{ $errors->first('taxes') }}</span>
                    @endif
                </div>
                <div class="col-xs-12 text-right">
                    <input type="submit" value="{{ __('validation.attributes.edit') }}" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
