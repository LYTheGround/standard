@extends('layouts.app')
@section('page-title')
    {{ __('buy/buy.buy') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-7">
                    <h4 class="page-title">{{ __('buy/buy.buy') }}</h4>
                </div>
                <div class="col-xs-5 text-right">
                    {{ Form::open(['method' => "DELETE", 'url' => route('buy.destroy',compact('buy'))]) }}
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> <span>{{ __('validation.attributes.delete') }}</span>
                    </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="row">
            <!-- trade -->
            <div class="col-xs-6">
                @include('trade.buy._trade')
            </div>
            <div class="col-xs-6">
                @include('trade.buy._upload')
            </div>
        </div>
        <div class="row">
            <!-- purchases -->
            <div class="col-xs-6">
                @include('trade.buy.purchase._list')
            </div>
            <div class="col-xs-6">
                @include('trade.buy.quote._list')
            </div>
        </div>
        <div class="card-box">
            <div class="card-title">
                <h4>liste des vente associé</h4>
            </div>
            <div class="row">
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="display table table-stripped">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__("deal/deal.deals")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.progress")) }}</th>
                                <th class="text-center">{{ __('validation.attributes.ttc') }}</th>
                                <th class="text-right">{{ ucfirst(__("validation.attributes.month")) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buy->purchases as $purchase)
                            @foreach($purchase->solds as $sold)
                                @can('view',$sold->trade)
                                    <tr>
                                        <td>
                                            @if($sold->trade->quote)
                                                <a href="#" class="avatar"
                                                   title="{{ $sold->trade->quote->deal->infoBox->name }}">{{ strtoupper(substr($sold->trade->quote->deal->infoBox->name,0,1))  }}</a>
                                                <h2>
                                                    <a href="{{ route('deal.show',['deal' =>$sold->trade->quote->deal ]) }}">{{ $sold->trade->quote->deal->infoBox->name  }}</a>
                                                </h2>
                                            @else
                                                <a href="#" class="avatar"
                                                   title="{{ __('validation.attributes.inconnu') }}">{{ strtoupper(substr(__('validation.attributes.inconnu'),0,1))  }}</a>
                                                <h2>
                                                    <a href="#">{{ __('validation.attributes.inconnu')  }}</a>
                                                </h2>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('sale.show',['sale' => $sold->trade]) }}">
                                                <div class="progress progress-xs progress-striped"
                                                     style="background: gray;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         data-toggle="tooltip" title="{{ $sold->trade->progress }}%"
                                                         style="width: {{ $sold->trade->progress }}%"></div>
                                                </div>
                                                <div class="text-center">
                                                    <span>{{ $sold->trade->progress }}%</span>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-center">{{ ($sold->trade->quote) ? $sold->trade->quote->ttc : 0 }}</td>
                                        <td class="text-right">{{ (isset($sold->trade->terms[0]))  ? \Carbon\Carbon::parse($sold->trade->terms[0]->month->month)->format('m-Y') : __('validation.attributes.inconnu') }}</td>
                                    </tr>
                                @endcan
                            @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop