@extends('layouts.app')
@section('page-title')
   {{ __('deal/deal.list') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">List des Deals</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('deal.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> {{ __('deal/deal.create') }}
                </a>
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
                                <th class="text-right">{{ __('validation.attributes.speaker') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deals as $deal)
                                <tr>
                                    <td>
                                            <a href="#" class="avatar"
                                               title="{{ $deal->infoBox->name }}">{{ strtoupper(substr($deal->infoBox->name,0,1))  }}</a>
                                        <h2>
                                            <a href="{{ route('deal.show',compact('deal')) }}">{{ $deal->infoBox->name  }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $deal->infoBox->emails[0]->email }}</td>
                                    <td>{{ $deal->infoBox->tels[0]->tel }}</td>
                                    <td class="text-right">{{ $deal->infoBox->speaker }}</td>
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