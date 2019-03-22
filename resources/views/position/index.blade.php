@extends("layouts.app")
@section('page-title')
    {{__("rh/position.list")}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-3">
                <h4 class="page-title">{{__("rh/position.list")}}</h4>
            </div>
            <div class="col-sm-8 col-xs-9 text-right m-b-20">
                <a href="#" data-toggle="modal" data-target="#add_position"
                   class="btn btn-primary"><i
                        class="fa fa-plus"></i> {{__('rh/position.create')}}</a>
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
                                    <th>{{__('validation.attributes.username')}}</th>
                                    <th class="text-center">{{__('validation.attributes.phone')}}</th>
                                    <th class="text-center">{{__('validation.attributes.email')}}</th>
                                    <th class="text-center">{{__('validation.attributes.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($positions)
                                    @foreach($positions as $position)
                                        <tr>
                                            <td>
                                                <a href="{{ route('position.show',compact('position')) }}">
                                                    @if($position->info->face)
                                                        <img src="{{ asset('storage/' . $position->info->face) }}"
                                                             class="avatar"
                                                             alt="{{ $position->info->last_name . ' ' . $position->info->first_name }}" title="{{ $position->info->last_name . ' ' . $position->info->first_name}}">
                                                    @else
                                                        <span class="avatar">{{ substr($position->info->last_name, 0, 1) }}</span>
                                                    @endif
                                                        <h2>{{strtoupper($position->info->last_name) . ' ' . ucfirst($position->info->first_name)}}</h2>
                                                </a>

                                            </td>
                                            <td class="text-center">{{$position->info->tels[0]->tel}}</td>
                                            <td class="text-center">{{$position->info->emails[0]->email}}</td>

                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                       data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu pull-right">
                                                        @can('update',$position)
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#edit_position{{$position->id}}"><i
                                                                    class="fa fa-pencil m-r-5"></i> {{ __('validation.attributes.edit') }}
                                                            </a></li>
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#delete_position{{ $position->id }}"><i
                                                                    class="fa fa-trash-o m-r-5"></i> {{ __('validation.attributes.delete') }}
                                                            </a></li>
                                                            @endcan
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('position._create_modal',['submit' => __('rh/position.create')])
    @foreach($positions as $position)
        @include('position._edit_modal',['submit' => __('rh/position.edit'),'position' => $position])
        @include('position._delete_modal',compact('position'))
    @endforeach
@stop
