@extends("layouts.app")
@section('page-title')
    {{__('rh/position.create')}}
@stop
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <h1 class="page-title">{{__('rh/position.create')}}</h1>
        </div>
        <div class="card-box">
            <div class="row">
                @include('position._form',['submit' => __('rh/position.create'), 'fa' => 'fa-plus'])
            </div>
        </div>
    </div>

@stop
