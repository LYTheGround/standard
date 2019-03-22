@extends('layouts.admin.admin')
@section('page-title')
    {{ $company->info_box->name }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-b-30">
            <div class="col-xs-7">
                <h3>{{ $company->info_box->name }}</h3>

            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('company.edit',compact('company')) }}" class="btn btn-success"><i class="fa fa-edit"></i> {{ __('validation.attributes.edit') }}</a>
                @can('owner',\App\Admin::class)
                <a href="{{ route('company.sold',compact('company')) }}" class="btn btn-primary"><i class="fa fa-money"></i> {{ __('validation.attributes.sold') }}</a>
                <a href="{{ route('company.status',compact('company')) }}" class="btn btn-danger"><i class="fa fa-flag"></i> {{ __('validation.attributes.status') }}</a>
                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete_company"><i class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}</a>
                @endcan
                {{--<a href="{{ route('taxes.edit',compact('company')) }}" class="btn btn-warning"><i class="fa fa-tasks"></i> {{ __('validation.attributes.taxes') }}</a>
                --}}
            </div>
        </div>
        <div class="row m-b-0">
            <div class="card-box m-b-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img src="{{ asset('storage/' . $company->info_box->brand)}}" class="avatar"></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0">{{$company->info_box->name}}</h3>
                                            <div class="staff-id"><b>{{__('validation.attributes.email')}}</b> : <a href="#">{{$company->info_box->emails[0]->email}}</a></div>
                                            <div class="staff-id"><b>{{__('validation.attributes.fax')}}</b> : {{ ($company->info_box->fax) ?: __('validation.attributes.inconnu')}}</div>
                                            <div class="staff-id"><b>{{__('validation.attributes.phone')}}</b> : <a href="#">{{ $company->info_box->tels[0]->tel}}</a></div>
                                            <div class="staff-id"><b>{{__('validation.attributes.speaker')}}</b> : {{$company->info_box->speaker}}</div>
                                            <div class="staff-id"><b>{{__('validation.attributes.sold')}}</b> : {{$company->premium->sold}}</div>
                                            <div class="staff-id"><b>{{__('validation.attributes.status')}}</b> : {{$company->premium->status->status}}</div>
                                            <div class="staff-id"><b>{{__('validation.attributes.token')}}</b> : {{ ($token) ? $token->token : __('validation.attributes.inconnu') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.address')}} :</span>
                                                <span class="text">{{$company->info_box->address }}</span>
                                            </li>
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.build')}} :</span>
                                                <span class="text">{{$company->info_box->build }}</span>
                                            </li>
                                            @if($company->info_box->floor)
                                                <li class="row">
                                                    <span class="title">{{__('validation.attributes.floor')}} :</span>
                                                    <span class="text">{{$company->info_box->floor }}</span>
                                                </li>
                                            @endif
                                            @if($company->info_box->apt_nbr)
                                                <li class="row">
                                                    <span class="title">{{__('validation.attributes.apt_nbr')}} :</span>
                                                    <span class="text">{{$company->info_box->apt_nbr }}</span>
                                                </li>
                                            @endif
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.city')}} :</span>
                                                <span class="text">{{$company->info_box->city->city }}</span>
                                            </li>
                                            @if($company->info_box->apt_nbr)
                                                <li class="row">
                                                    <span class="title">{{__('validation.attributes.zip')}} :</span>
                                                    <span class="text">{{$company->info_box->zip }}</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete_company" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $company->info_box->name }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('diver.sur') }}</p>
                        <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">{{ __('diver.close') }}</a>
                            <span onclick="event.preventDefault();document.getElementById('{{ 'delete-company' }}').submit()" class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                            {{ Form::open(['method' => 'DELETE', 'url' => route('company.destroy',compact('company')), 'id' => 'delete-company']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
