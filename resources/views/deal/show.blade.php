@extends("layouts.app")
@section('page-title')
    {{ ucfirst($deal->infoBox->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ ucfirst($deal->infoBox->name) }}</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('deal.edit', compact('deal')) }}" class="btn btn-primary m-b-5">
                    <i class="fa fa-edit"></i> {{__('validation.attributes.edit')}}
                </a>
                <a href="#" data-toggle="modal" data-target="#delete_deal" class="btn btn-danger m-b-5">
                    <i class="fa fa-trash"></i>  {{__('validation.attributes.delete')}}
                </a>
            </div>
        </div>
        <div class="card-box m-b-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><span class="avatar">{{ substr($deal->infoBox->name,0,1) }}</span></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0">{{$deal->infoBox->name}}</h3>
                                        <div class="staff-id"><b>{{__('validation.attributes.email')}}</b> : <a href="#">{{$deal->infoBox->emails[0]->email}}</a></div>
                                        <div class="staff-id"><b>{{__('validation.attributes.fax')}}</b> : {{ ($deal->infoBox->fax) ?: __('validation.attributes.inconnu')}}</div>
                                        <div class="staff-id"><b>{{__('validation.attributes.phone')}}</b> : <a href="#">{{ $deal->infoBox->tels[0]->tel}}</a></div>
                                        <div class="staff-id"><b>{{__('validation.attributes.speaker')}}</b> : {{$deal->infoBox->speaker}}</div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.address')}} :</span>
                                            <span class="text">{{$deal->infoBox->address }}</span>
                                        </li>
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.build')}} :</span>
                                            <span class="text">{{$deal->infoBox->build }}</span>
                                        </li>
                                        @if($deal->infoBox->floor)
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.floor')}} :</span>
                                                <span class="text">{{$deal->infoBox->floor }}</span>
                                            </li>
                                        @endif
                                        @if($deal->infoBox->apt_nbr)
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.apt_nbr')}} :</span>
                                                <span class="text">{{$deal->infoBox->apt_nbr }}</span>
                                            </li>
                                        @endif
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.city')}} :</span>
                                            <span class="text">{{$deal->infoBox->city->city }}</span>
                                        </li>
                                        @if($deal->infoBox->apt_nbr)
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.zip')}} :</span>
                                                <span class="text">{{$deal->infoBox->zip }}</span>
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
    <div id="delete_deal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $deal->name}}</h4>
                </div>
                <div class="modal-body card-box">
                    <p>{{ __('diver.sur') }}</p>
                    {!! __('deal.deal.modal_delete') !!}
                    <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">{{ ucfirst(__('validation.attributes.close')) }}</a>
                        <span onclick="event.preventDefault();document.getElementById('{{ 'delete-deal' }}').submit()" class="btn btn-danger">{{ ucfirst(__('validation.attributes.delete')) }}</span>
                        <form action="{{route('deal.destroy',compact('deal'))}}" method="POST" id="{{ 'delete-deal'  }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
