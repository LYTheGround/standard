@extends('layouts.app')
@section('page-title')
    {{ __('token.list') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ __('token.list') }}</h4>
            </div>
            <div class="col-xs-5 text-right m-b-30">
                <a href="#"
                   class="btn btn-default disabled">{{ ucfirst(__('validation.attributes.soldLeft')). ' : ' . auth()->user()->member->company->premium->sold }}</a>
                @if(auth()->user()->member->company->premium->sold > 0)
                    <a href="{{ route('token.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> {{ __('token.create') }}</a>
                @endif
            </div>
        </div>
        <div class="card-box">

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped datatable custom-table">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__('validation.attributes.token')) }}</th>
                                <th>{{ ucfirst(__('validation.attributes.category')) }}</th>
                                <th>{{ ucfirst(__('validation.attributes.range')) }}</th>
                                <th class="text-right">{{ ucfirst(__('validation.attributes.action')) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tokens as $token)
                                <tr>
                                    <td>{{ $token->token }}</td>
                                    <td>{{ $token->category->category }}</td>
                                    <td>{{ $token->range }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal"
                                                       data-target="#delete_token{{$token->id}}"><i
                                                                class="fa fa-trash-o m-r-5"></i> {{ __('token.delete') }}
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @foreach($tokens as $token)
            <div id="delete_token{{ $token->id }}" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('token.delete') }}</h4>
                        </div>
                        <div class="modal-body card-box">
                            <p>{{ __('diver.sur') }}</p>
                            <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">{{ __('diver.close') }}</a>
                                <span
                                        onclick="event.preventDefault();document.getElementById('{{ 'delete-token-' . $token->id }}').submit()"
                                        class="btn btn-danger">{{ __('token.delete') }}</span>
                                <form id="delete-token-{{$token->id}}"
                                      action="{{ route('token.destroy',compact('token')) }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
