@extends('layouts.app')
@section('page-title')
    liste unload
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 text-right m-b-30">
                <a href="{{ route('unload.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> create</a>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>{{ __('rh/member.list') }}</th>
                                <th>{{ __('validation.attributes.price') }}</th>
                                <th class="text-right">{{ __('validation.attributes.date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unloads as $unload)
                                <tr>
                                    <td>
                                        @if($unload->member->info->face)
                                            <img src="{{ asset('storage/' . $unload->member->info->face) }}" class="avatar"
                                                 alt="{{ $unload->member->name }}" title="{{ $unload->member->name }}">
                                        @else
                                            <a href="#" class="avatar"
                                               title="{{ $unload->member->name }}">{{ strtoupper(substr($unload->member->name,0,1))  }}</a>
                                        @endif
                                        <h2>
                                            <a href="{{ route('member.show',['member' => $unload->member]) }}">{{ $unload->member->info->full_name  }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $unload->prince }}</td>
                                    <td class="text-right">{{ $unload->date }}</td>

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