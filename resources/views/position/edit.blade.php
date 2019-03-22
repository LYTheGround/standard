@extends("layouts.app")
@section('page-title')
    {{__('rh/position.edit')}}
@stop
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <h1 class="page-title">{{__('rh/position.edit')}}</h1>
        </div>
        <div class="card-box">
            <div class="row">
                @include('position._form',['submit' => __('rh/position.edit'),'info' => $position->info, 'fa' => 'fa-edit'])
            </div>
        </div>
    </div>

@stop
