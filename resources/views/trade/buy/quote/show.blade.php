@extends('layouts.app')
@section('page-title')
    devi
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-b-15">
            <div class="col-xs-12 text-right">
                @can('confirmQuote',$buy)
                    @if($quote->selected)
                        <a href="{{ route('buy.quote.confirmed',compact('buy')) }}"
                           class="btn btn-sm btn-success"> <i class="fa fa-check"></i> {{ __('confirm') }}</a>
                    @else
                        <a href="{{ route('buy.quote.selected',compact('quote','buy')) }}"
                           class="btn btn-primary"><i class="fa fa-check"></i> selected</a>
                    @endif
                    <a href="#" class="btn btn-sm btn-danger"
                       data-toggle="modal" data-target="#delete_quote{{ $quote->id }}"> <i
                                class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}</a>

                @endcan
                @can('deleteConfirmQuote',$buy)
                    <a href="{{ route('buy.quote.not_confirmed',compact('buy')) }}"
                       class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> supprimé la confirmation</a>
                @endcan
            </div>
        </div>
        <div class="card-box">
            <div class="card-title">Le deal</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#" class="avatar"
                                           title="{{ $quote->deal->infoBox->name }}">{{ strtoupper(substr($quote->deal->infoBox->name,0,1))  }}</a>
                                        <h2>
                                            <a href="{{ route('deal.show',['deal' => $quote->deal]) }}">{{ $quote->deal->infoBox->name  }}</a>
                                        </h2>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="display table dataTable table-stripped">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__("storage/product.products")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.qt")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.ht")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.tva")) }}</th>
                                <th class="text-right">{{ ucfirst(__("validation.attributes.ttc")) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quote->orders as $order)
                                <tr>
                                    <td>
                                        @if(isset($order->purchase->product->imgs[0]))
                                            <img src="{{ asset('storage/' . $order->purchase->product->imgs[0]->img) }}"
                                                 class="avatar"
                                                 alt="{{ $order->purchase->product->name }}"
                                                 title="{{ $order->purchase->product->name }}">
                                        @else
                                            <a href="#" class="avatar"
                                               title="{{ $order->purchase->product->name }}">{{ strtoupper(substr($order->purchase->product->name,0,1))  }}</a>
                                        @endif
                                        <h2>
                                            <a href="{{ route('product.show',['product' => $order->purchase->product]) }}">{{ $order->purchase->product->name  }}</a>
                                            <span>#REF-{{ $order->purchase->product->ref }}</span>
                                            <small class="text-muted">{{ substr($order->purchase->product->description,0,15) }}</small>
                                        </h2>
                                    </td>
                                    <td>{{ $order->purchase->qt }}</td>
                                    <td>{{ $order->ht }}</td>
                                    <td>{{ $order->tva }}</td>
                                    <td class="text-right">{{ $order->ttc }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"><span class="text-muted">TOTALE</span></td>
                                <td>{{ $quote->ht }}</td>
                                <td>{{ $quote->tva }}</td>
                                <td class="text-right bg-danger">{{ $quote->ttc }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete_quote{{ $quote->id }}" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ 'devi' }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('pages.diver.sure') }}</p>
                        {!! __('storage/product.modal_delete') !!}
                        <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">{{ __('validation.attributes.close') }}</a>
                            <span onclick="event.preventDefault();document.getElementById('{{ 'delete-quote-' . $quote->id }}').submit()" class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                            {{ Form::open(['method' => 'DELETE','url' => route('buy.quote.delete',compact('quote','buy')),'id' => 'delete-quote-' . $quote->id ]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop