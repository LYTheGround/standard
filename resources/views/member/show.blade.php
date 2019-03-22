@extends('layouts.app')
@section('page-title')
    {{ ucfirst($member->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 text-right m-b-30">

                @can('delete',$member)
                    <a href="#" data-toggle="modal" data-target="#delete_member" class="btn btn-danger"><i
                                class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}</a>

                @endcan

                @can('range',$member)
                    <a href="{{ route('member.range',compact('member')) }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> {{ __('rh/member.range_title') }}</a>

                @endcan
                @if($member->premium->category->category != 'pdg' && $member->premium->update_status < gmdate('Y-m-d'))
                    <a href="{{ route('member.status',compact('member')) }}" class="btn btn-success"><i
                                class="fa fa-edit"></i> {{ __('validation.attributes.status') }}</a>
                @endif
                @cannot('range',$member)
                    @if($member->premium->update_status >= gmdate('Y-m-d'))
                        <div>
                            <span> {!!  __('rh/member.status_bloque',['value' =>  '<span class="label label-danger-border">' . Carbon\Carbon::parse($member->premium->update_status)->format('d-m-Y') . '</span>' ]) !!}</span>
                        </div>
                    @endif
                @endcannot
            </div>
        </div>

        <div class="card-box m-b-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view m-b-15">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#">
                                    <img class="avatar"
                                         src="{{ ($member->info->face) ? asset('storage/' . $member->info->face) : asset('img/user.jpg') }}"
                                         alt="{{ $member->name }}" title="{{ $member->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 m-b-0">{{ $member->info->full_name }}</h3>
                                        <small
                                                class="text-muted">{{ ucfirst($member->premium->category->category) }}</small>
                                        <div class="staff-id">{{ __('validation.attributes.id') }}
                                            : {{ $member->slug }}</div>
                                        <div class="staff-id">{{ ucfirst(__('validation.attributes.status')) }} :
                                            @if($member->premium->status->status === 'inactive')
                                                <span class="label label-warning-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @elseif($member->premium->status->status === 'active')
                                                <span class="label label-success-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @else
                                                <span class="label label-danger-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @endif
                                        </div>
                                        <div class="staff-id">{{ __('validation.attributes.limit_date') .' : '}}{{ ($member->premium->limit) ? Carbon\Carbon::parse($member->premium->limit)->format('d-m-Y') : '' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.phone') }} :</span>
                                            <span class="text"><a href="#">{{ $member->info->tels[0]->tel }}</a></span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.email') }} :</span>
                                            <span class="text">
                                                <a href="#"
                                                   title="{{ $member->info->emails[0]->email }}">{{ $member->info->emails[0]->email }}</a>
                                            </span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.birth') }} :</span>
                                            <span
                                                    class="text">{{ ($member->info->birth) ? Carbon\Carbon::parse($member->info->birth)->format('d-m') : 'inconnu' }}</span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.address') }} :</span>
                                            <span class="text">
                                                {{ $member->info->address . ', ' . ucfirst($member->info->city->city) }}
                                            </span>
                                        </li>
                                        @if($member->info->sex)
                                            <li class="row text-left">
                                                <span class="title">{{ __('validation.attributes.sex') }} :</span>
                                                <span class="text">{{ $member->info->sex }}</span>
                                            </li>
                                        @endif
                                        @if($member->info->cin)
                                            <li class="row text-left">
                                                <span class="title">{{ __('validation.attributes.cin') }} :</span>
                                                <span class="text">{{ $member->info->cin }}</span>
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

        <div class="card-box tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs tabs nav-tabs-bottom">
                        @if(isset($member->listProducts()[0]))
                        <li class="active col-sm-3"><a data-toggle="tab"
                                                       href="#myproducts">{{ strtoupper(__('storage/product.list')) }}</a>
                        </li>
                        @endif
                        @if(isset($member->listDeals()[0]))
                            <li class="col-sm-3"><a data-toggle="tab"
                                                    href="#mydeals">{{ strtoupper(__('deal/deal.list')) }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content  profile-tab-content">
                    @if(isset($member->listProducts()[0]))
                        <div id="myproducts" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel member-panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">{{ strtoupper(__('storage/product.list')) }}</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="contact-list">
                                                @foreach($member->listProducts() as $product)
                                                    <li>
                                                        <div class="contact-cont">
                                                            <div class="pull-left user-img m-r-10">
                                                                <a href="#" title="{{ $product->name }}"><img
                                                                            src="{{ (isset($product->imgs[0])) ? asset('storage/' . $product->imgs[0]->img) : asset('img/placeholder.jpg') }}"
                                                                            alt="{{ $product->name }}"
                                                                            class="avatar"></a>
                                                            </div>
                                                            <div class="contact-info">
                                            <span
                                                    class="contact-name text-ellipsis">{{ $product->name }}</span>
                                                                <span class="contact-date">{{ '#REF-' . $product->ref }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="panel-footer text-center bg-white">
                                            <a href="{{ route('product.index') }}"
                                               class="text-primary">{{ __('storage/product.view_all') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(isset($member->listDeals()[0]))
                        <div id="mydeals" class="tab-pane fade in ">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel member-panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">{{ strtoupper(__('deal/deal.list')) }}</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="contact-list">
                                                @foreach($member->listDeals() as $deal)
                                                    <li>
                                                        <div class="contact-cont ">
                                                            <div class="pull-left user-img m-r-10 ">
                                                                <a href="#" title="{{ $deal->infoBox->name }}"
                                                                   class="avatar">
                                                                    {{ substr($deal->infoBox->name,0,1) }}</a>
                                                            </div>
                                                            <div class="contact-info">
                                            <span class="contact-name text-ellipsis">
                                                <a href="{{ route('deal.show',compact('deal')) }}">{{ $deal->infoBox->name }}</a>
                                            </span>
                                                                <span class="contact-date">{{ $deal->infoBox->speaker }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="panel-footer text-center bg-white">
                                            <a href="{{ route('deal.index') }}"
                                               class="text-primary">{{ __('deal/deal.view_all') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div id="delete_member" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $member->info->name }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('diver.sur') }}</p>
                        <p>{!!  __('rh/member.delete_modal') !!}</p>
                        <div class="m-t-20"><a href="#" class="btn btn-default"
                                               data-dismiss="modal">{{ __('diver.close') }}</a>
                            <span onclick="event.preventDefault();document.getElementById('{{ 'delete-member' }}').submit()"
                                  class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                            {{ Form::open(['method' => 'DELETE', 'url' => route('member.destroy',compact('member')), 'id' => 'delete-member']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop