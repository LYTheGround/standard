@extends('layouts.app')
@section('page-title')
    {{ __('token.create') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <h3>{{ __('token.create')  }}</h3>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <div class="dash-widget dash-widget5">
                    <span class="dash-widget-icon @if($company->premium->sold > 10) bg-success @elseif ($company->premium->sold > 5) bg-warning @else bg-danger @endif">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </span>
                    <div class="dash-widget-info m-b-10">
                        <span>{{ __('token.company_sold') }} : </span>
                        <h2>{{ $company->premium->sold . ' ' . __('validation.attributes.days') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                <div class="row">
                    {{ Form::open(['method' => 'POST', 'url' => route('token.store'), 'class' => 'form-horizontal']) }}
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    {{ Form::label('category',__('validation.attributes.category'),['class' => 'label-control']) }}
                                    <select name="category" id="category" title="category" class="form-control" required>
                                        <option value="3" {{ (old('category') == '3') ? 'selected' : '' }}>{{ __('category.manager') }}</option>
                                        <option value="4" {{ (old('category') == '4') ? 'selected' : '' }}>{{ __('category.accounting') }}</option>
                                        <option value="5" {{ (old('category') == '5') ? 'selected' : '' }}>{{ __('category.commercial') }}</option>
                                        <option value="6" {{ (old('category') == '6') ? 'selected' : '' }}>{{ __('category.delivery') }}</option>
                                        <option value="7" {{ (old('category') == '7') ? 'selected' : '' }}>{{ __('category.storekeeper') }}</option>
                                    </select>
                                    @if($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('range',__('validation.attributes.range'),['class'=>'label-form']) }}
                                    {{ Form::number('range',null,['class'=>'form-control','min'=>'1','required']) }}
                                    @if($errors->has('range'))
                                        <span class="text-danger">{{ $errors->first('range') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __('token.create') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
