@extends('layouts.app')
@section('page-title')
    {{ __('rh/member.list') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1 class="page-title">{{ __('rh/member.list') }}</h1>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>{{ __('validation.attributes.name') }}</th>
                                <th>{{ __('validation.attributes.email') }}</th>
                                <th>{{ __('validation.attributes.mobile') }}</th>
                                <th>{{ __('validation.attributes.status') }}</th>
                                @can('range',auth()->user()->member)
                                    <th class="text-right">{{ __('validation.attributes.action') }}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>
                                        @if($member->info->face)
                                            <img src="{{ asset('storage/' . $member->info->face) }}" class="avatar"
                                                 alt="{{ $member->name }}" title="{{ $member->name }}">
                                        @else
                                            <a href="#" class="avatar"
                                               title="{{ $member->name }}">{{ strtoupper(substr($member->name,0,1))  }}</a>
                                        @endif
                                        <h2>
                                            <a href="{{ route('member.show',compact('member')) }}">{{ $member->info->full_name  }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $member->info->emails[0]->email }}</td>
                                    <td>{{ $member->info->tels[0]->tel }}</td>
                                    <td><span
                                                class="label {{ ($member->premium->status->status != 'active') ? ($member->premium->status->status != 'inactive') ? 'label-danger-border' : 'label-warning-border' : 'label-success-border'}}">{{ __('status.' . $member->premium->status->status) }}</span>
                                    </td>
                                    @can('range',auth()->user()->member)
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <ul class="dropdown-menu pull-right">
                                                    @if($member->premium->status->status == 'active')
                                                        <li><a href="{{ route('member.range',compact('member')) }}"><i
                                                                        class="fa fa-plus m-r-5"></i> {{ __('validation.attributes.range') }}</a></li>
                                                    @endif
                                                    @if($member->premium->update_status < gmdate('Y-m-d'))
                                                        <li><a href="{{ route('member.status',compact('member')) }}"><i
                                                                        class="fa fa-pencil m-r-5"></i> {{ __('validation.attributes.status') }}</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    @endcan
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
