@extends('layouts.app')
@section('page-title')
    {{ $unload->name }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="page-title">{{ $unload->name }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="mailview-content">
                        <div class="mailview-header">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="text-ellipsis m-b-10">
                                        <span class="mail-view-title">{{ strtoupper($unload->name) }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mail-view-action">
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal"
                                               data-target="#delete-unload">
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash-o"></i></button>
                                            </a>
                                            <a href="{{ route('unload.create') }}">
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="create"> <i class="fa fa-plus"></i></button>
                                            </a>
                                            <a href="{{ route('unload.edit',compact('unload')) }}">
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="edit"> <i class="fa fa-edit"></i></button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sender-info">
                                <div class="sender-img">
                                    <img width="40" title="{{ $unload->member->info->full_name }}" alt="{{ $unload->member->name }}" src="{{ ($unload->member->info->face) ? asset('storage/' . $unload->member->info->face) : asset('img/user.jpg') }}" class="img-circle">
                                </div>
                                <div class="receiver-details pull-left">
                                    <span class="sender-name">{{ $unload->member->info->full_name }} ({{ $unload->member->info->emails[0]->email }})</span>
                                    <span class="receiver-name"></span>
                                </div>
                                <div class="mail-sent-time">
                                    <span class="mail-time">{{ Carbon\Carbon::parse($unload->created_at)->format('d-m-y H:i') }}</span>
                                    <h4 class="mail-time text-danger">{{ $unload->prince }} MAD</h4>
                                    <span class="mail-time">{{ __('validation.attributes.onUnload') . ' : ' }}{{ ($unload->tva) ? 'TVA' : 'IS'}}</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        @if($unload->description)
                            <div class="mailview-inner">
                                <p>{{ $unload->description }}
                                    <br> {{ $unload->member->info->full_name }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="mail-attachments">
                        <p><i class="fa fa-paperclip"></i> 1 Attachments - <a href="{{ asset('storage/' . $unload->justify) }}">View justify</a></p>
                        <ul class="attachments clearfix">
                            <li>
                                <div class="attach-file"><img src="{{ asset('storage/' . $unload->justify) }}" alt="{{ $unload->name }}"></div>
                                <div class="attach-info"> <a href="{{ asset('storage/' . $unload->justify) }}" class="attach-filename">{{ $unload->name }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="mailview-footer">
                        <div class="row">
                            <div class="col-sm-6 left-action">
                                <a href="{{ route('unload.create') }}">
                                    <button type="button" class="btn btn-default"><i class="fa fa-plus"></i> {{ __('validation.attributes.create') }}</button>
                                </a>
                                <a href="{{ route('unload.edit',compact('unload')) }}">
                                    <button type="button" class="btn btn-default"><i class="fa fa-edit"></i> {{ __('validation.attributes.edit') }}</button>
                                </a>
                            </div>
                            <div class="col-sm-6 right-action">
                                <a href="#" data-toggle="modal"
                                   data-target="#delete-unload">
                                    <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> {{ __('validation.attributes.delete') }}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete-unload" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('validation.attributes.unload') }}: {{ $unload->name }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('pages.diver.sure') }}</p>
                        <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">{{ ucfirst(__('validation.attributes.close')) }}</a>
                            <span
                                    onclick="event.preventDefault();document.getElementById('delete-unload-form').submit()"
                                    class="btn btn-danger">{{ ucfirst(__('validation.attributes.delete')) }}</span>
                            {{ Form::open(['method' => 'delete', 'url' => route('unload.destroy',compact('unload')),'id' => 'delete-unload-form', 'style' => "display:none"  ]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
