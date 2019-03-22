@extends('layouts.admin.admin')
@section('page-title')
    {{ $admin->user->login }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h3>{{ $admin->user->login }}</h3>
            </div>
            <div class="col-xs-5 text-right m-b-10">
                @can('owner',\App\Admin::class)
                <a href="#"  data-toggle="modal" data-target="#delete_admin" class="btn btn-danger" >
                    <i class="fa fa-trash"></i> {{ __('admin/admin.delete') }}
                </a>
                @endcan
                <a href="{{ route('company.create') }}" class="btn btn-primary" >
                    <i class="fa fa-plus"></i> {{ __('company/company.create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="display datatable table table-stripped">
                                <thead>
                                <tr>
                                    <th>{{ __('validation.attributes.name') }}</th>
                                    <th>{{ __('validation.attributes.phone') }}</th>
                                    <th>{{ __('validation.attributes.speaker') }}</th>
                                    <th>{{ __('validation.attributes.email') }}</th>
                                    <th>{{ __('validation.attributes.status') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admin->companies as $company)

                                    <tr>
                                        <td><a href="{{ route('company.show',compact('company')) }}">{{ $company->info_box->name }}</a></td>
                                        <td>{{ $company->info_box->tels[0]->tel }}</td>
                                        <td>{{ $company->info_box->speaker }}</td>
                                        <td>{{ $company->info_box->emails[0]->email }}</td>
                                        <td>{{ $company->premium->status->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete_admin" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">Admin : {{ $admin->user->login }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('diver.sur') }}</p>
                        <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <span onclick="event.preventDefault();document.getElementById('{{ 'delete-admin-' . $admin->id }}').submit()" class="btn btn-danger">Delete</span>
                            <form action="{{route('admin.destroy',compact('admin'))}}" method="POST" id="{{ 'delete-admin-' . $admin->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
