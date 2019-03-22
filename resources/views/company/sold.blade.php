@extends('layouts.admin.admin')
@section('page-title')
    {{ ucfirst(__('validation.attributes.sold'))  }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row card-box">
            <div class="card-title text-right">
                {!! __('validation.attributes.soldLeft') . ' : <b>' . $company->premium->sold . '</b> ' . __('validation.attributes.day') !!}
            </div>
            {{ Form::open(['method' => 'PUT', 'url' => route('company.updateSold',compact('company'))]) }}
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        {{ Form::label('sold','Sold :',['class' => 'control-label']) }}
                        {{ Form::number('sold',null,['class'=> 'form-control','placeholder' => 'Sold :', 'min' => 1, 'required']) }}
                    </div>
                    @if($errors->has('sold'))
                        <span class="text-danger">{{ $errors->first('sold') }}</span>
                    @endif
                </div>
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-edit"></i> {{ __('validation.attributes.edit') }}
                    </button>
                 </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
