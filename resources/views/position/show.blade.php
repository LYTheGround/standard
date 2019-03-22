@extends("layouts.app")
@section('page-title')
    {{ $position->info->full_name }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ $position->info->full_name }}</h4>
            </div>
            @can('update',$position)
                <div class="col-xs-5 text-right m-b-30">
                    <a href="#" data-toggle="modal" data-target="#edit_position{{ $position->id }}"
                       class="btn btn-primary m-b-10">
                        <i class="fa fa-edit"></i> {{__('rh/position.edit')}}
                    </a>
                    <a href="#" data-toggle="modal" data-target="#delete_position{{ $position->id }}"
                       class="btn btn-danger m-b-10">
                        <i class="fa fa-trash"></i> {{__('rh/position.delete')}}
                    </a>
                </div>
            @endcan
        </div>
        <div class="card-box m-b-0 ">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view m-b-30">
                        <div class="row m-b-30">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    @if($position->info->face)
                                        <a href="#"><img class="avatar"
                                                         src="{{ ($position->info->face) ? asset('storage/'. $position->info->face) : asset('img/user.jpg') }}"
                                                         alt=""></a>
                                    @else
                                        <a href="#"><span
                                                class="avatar">{{ substr($position->info->first_name,0,1) }}</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0">{{$position->info->full_name }}</h3>
                                        <div class="staff-id">{{__('validation.attributes.position')}}
                                            : {{$position->position}}</div>
                                        <div class="staff-id">{{__('validation.attributes.cin')}}
                                            : {{($position->info->cin) ?: 'inconnu'}}</div>
                                        <div class="staff-id">{{__('validation.attributes.birth')}}
                                            : {{($position->info->birth) ? \Carbon\Carbon::parse($position->info->birth)->format('d-m') : 'inconnu'}}</div>
                                        <div class="staff-id">{{__('validation.attributes.sex')}}
                                            : {{($position->info->sex) ?__('validation.attributes.' . $position->info->sex) : 'inconnu'}}</div>

                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.mobile')}} :</span>
                                            <span class="text"><span>{{$position->info->tels[0]->tel}}</span></span>
                                        </li>
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.email')}} :</span>
                                            <span class="text"><span>{{$position->info->emails[0]->email}}</span></span>
                                        </li>
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.address')}} :</span>
                                            <span class="text"><span>{{($position->info->address) ?: 'inconnu'}}</span></span>
                                        </li>
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.city')}} :</span>
                                            <span
                                                class="text"><span>{{($position->info->city->city)?: 'inconnu'}}</span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('position._edit_modal',['submit' => __('rh/position.edit'),'position' => $position])
    @include('position._delete_modal',compact('position'))
@stop
