@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('validation.attributes.status')) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="card-box">
                {{ Form::open(['method' => 'PUT', 'url' => route('member.status.update',compact('member')),'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-12 m-b-30">
                            <label for="status" class="control-label">{{ __('validation.attributes.status') . ' : ' }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ ($member->premium->status->status == 'inactive') ? 'selected' : '' }}>{{ __('status.inactive') }}</option>
                                <option value="2" {{ ($member->premium->status->status == 'active') ? 'selected' : '' }}>{{ __('status.active') }}</option>
                                <option value="3" {{ ($member->premium->status->status == 'archived') ? 'selected' : '' }}>{{ __('status.archived') }}</option>
                            </select>
                        </div>
                        @if($errors->has('status'))
                            <span class="error-box text-danger">{{ $errors->first('status') }}</span>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_status">
                            <i class="fa fa-edit"></i> {{ __('rh/member.status_update') }}
                        </a>
                    </div>
                </div>
                <div id="edit_status" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content modal-md">
                            <div class="modal-header">
                                <h4 class="modal-title">{{ __('validation.attributes.status') }} : </h4>
                            </div>
                            <div class="modal-body card-box">
                                <p>{{ __('diver.sur') }}</p>
                                {!!  __('rh/member.status_modal') !!}
                                <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">{{ __('diver.close') }}</a>
                                    <input type="submit" class="btn btn-danger" value="{{ __('rh/member.status_update') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
