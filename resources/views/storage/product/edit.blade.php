@extends("layouts.app")
@section('page-title')
    {{__('storage/product.edit')}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{__('storage/product.edit')}}</h4>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    @include('storage.product._form',['submit' => __('storage/product.edit'), 'fa' => 'fa fa-edit'])
                </div>
            </div>
        </div>
    </div>
@stop