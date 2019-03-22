@extends("layouts.app")
@section('page-title')
    {{ __('deal/deal.edit')}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="page-title">{{ __('deal/deal.edit')}}</h4>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    @include('deal._form',['submit' => __('deal/deal.edit'), 'fa' => 'fa fa-edit'])
                </div>
            </div>
        </div>

    </div>

@stop