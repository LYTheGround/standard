@extends('layouts.app')
@section('page-title')
    {{ __('buy/buy.create') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ __('buy/buy.create') }}</h4>
            </div>
        </div>
        <div class="row card-box">
            {{ Form::open(['route' => 'buy.store']) }}
            <div class="row">
                <div class="col-xs-12">
                    @include('form.date',[
                    'name' => 'date',
                    'title' => __('buy/buy.create_date'),
                    'value' => (old('date')) ? old('date') : \Carbon\Carbon::now(),
                    'attributes' => ['required']
                    ])
                </div>
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> {{ __('buy/buy.created') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>

    </div>
@stop