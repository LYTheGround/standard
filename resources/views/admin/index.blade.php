@extends('layouts.admin.admin')
@section('page-title')
    {{ __('admin/admin.list') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>{{ __("admin/admin.list") }}</h1>
            </div>
            @can('owner',\App\Admin::class)
                <div class="col-xs-5 text-right">
                    <a href="{{ route('admin.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> {{ __('admin/admin.create') }}</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="card-box">
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="display table_desc datatable table table-stripped">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__("validation.attributes.username")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.email")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.phone")) }}</th>
                                <th class="text-right">{{ ucfirst(__("validation.attributes.city")) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Admin::liste() as $admin)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.show',compact('admin')) }}">{{ $admin->user->login }}</a>
                                    </td>
                                    <td>{{ $admin->user->email }}</td>
                                    <td>{{ $admin->user->admin->tel }}</td>
                                    <td class="text-right">{{ $admin->city->city }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
