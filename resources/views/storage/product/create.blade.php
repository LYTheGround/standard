@extends("layouts.app")
@section('page-title')
    {{ __('storage/product.create')}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="page-title">{{ __('storage/product.create')}}</h4>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    @include('storage.product._form',['submit' => __('storage/product.add'), 'fa' => 'fa fa-plus'])
                </div>
            </div>
        </div>

    </div>

@stop