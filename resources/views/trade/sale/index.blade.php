@extends('layouts.app')
@section('page-title')
    {{ __('buy/buy.buys') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-t-50">
            <div class="card-box">
                <div class="row">
                    {{ Form::open(['method' => 'GET', 'url' => route('sale.list')]) }}
                    <div class="col-xs-4">
                        @include('form.date',['name' => 'star','title' => 'De','value' => (isset($_GET['star'])) ? $_GET['star'] : null,'attributes' => ['required']])
                    </div>
                    <div class="col-xs-4">
                        @include('form.date',['name' => 'end','title' => 'à','value' =>   (isset($_GET['end'])) ? $_GET['end'] : null,'attributes' => ['required']])
                    </div>
                    <div class="col-xs-4 text-right">
                        <button type="submit" class="btn btn-primary">search</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div class="row m-b-30">
            <div class="col-xs-7">
                {{ __('sales') }}
            </div>

        </div>
        <div class="row">
            <div class="card-box">
                <div class="row">
                    <div class="card-title text-right">
                        <a href="{{ route('sale.create') }}"
                           class="btn btn-primary">
                            <i class="fa fa-plus"></i> {{ __('sale.create') }}</a>
                    </div>
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
                                @foreach($sales as $sale)
                                    @can('view',$sale)
                                        <tr>
                                            <td>
                                                @if($sale->quote)
                                                    <a href="#" class="avatar"
                                                       title="{{ $sale->quote->deal->infoBox->name }}">{{ strtoupper(substr($sale->quote->deal->infoBox->name,0,1))  }}</a>
                                                    <h2>
                                                        <a href="{{ route('deal.show',['deal' =>$sale->quote->deal ]) }}">{{ $sale->quote->deal->infoBox->name  }}</a>
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
                                                <a href="{{ route('sale.show',compact('sale')) }}">
                                                    <div class="progress progress-xs progress-striped"
                                                         style="background: gray;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                             data-toggle="tooltip" title="{{ $sale->progress }}%"
                                                             style="width: {{ $sale->progress }}%"></div>
                                                    </div>
                                                    <div class="text-center">
                                                        <span>{{ $sale->progress }}%</span>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="text-center">{{ ($sale->quote) ? $sale->quote->ttc : 0 }}</td>
                                            <td class="text-right">{{ (isset($sale->terms[0]))  ? \Carbon\Carbon::parse($sale->terms[0]->month->month)->format('m-Y') : __('validation.attributes.inconnu') }}</td>
                                        </tr>
                                    @endcan

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop