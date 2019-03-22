@extends('layouts.admin.admin')
@section('page-title')
    Dashboard
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="card-box col-md-6">
                <div class="card-title">
                    <h4>{{ __('admin/admin.list') }}</h4>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="display table_desc datatable table table-stripped">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__("validation.attributes.username")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.email")) }}</th>
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