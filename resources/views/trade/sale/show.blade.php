@extends('layouts.app')
@section('page-title')
    vente
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                Vente
            </div>
            <div class="col-xs-5 text-right">
                <a href="#" class="btn btn-sm btn-danger"
                   data-toggle="modal" data-target="#delete_sale{{ $sale->id }}"> <i
                            class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}</a>

            </div>
        </div>

        <div class="row m-t-20">
            <!-- trade -->
            <div class="col-xs-6">
                @include('trade.sale._trade')
            </div>
            <div class="col-xs-6 text-right">
                <a href="{{ route('sale.fc',compact('sale')) }}" class="btn btn-primary">FC</a>
                <a href="{{ route('sale.bl',compact('sale')) }}" class="btn btn-primary">BL</a>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                <div class="row">
                    <div class="card-title">Le deal</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="#" class="avatar"
                                               title="{{ $sale->quote->deal->infoBox->name }}">{{ strtoupper(substr($sale->quote->deal->infoBox->name,0,1))  }}</a>
                                            <h2>
                                                <a href="{{ route('deal.show',['deal' => $sale->quote->deal]) }}">{{ $sale->quote->deal->infoBox->name  }}</a>
                                            </h2>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="card-box">
                <div class="card-title">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            @can('confirmSold',$sale)
                                <a href="{{ route('sold.create',compact('sale')) }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Ajouté un produit
                                </a>
                                <a href="{{ route('sold.confirm',compact('sale')) }}" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Confirm
                                </a>
                            @endcan
                            @can('deleteConfirmSold',$sale)
                                <a href="{{ route('sold.destroy.confirm',compact('sale')) }}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> supprimé la Confirmation
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="display table dataTable table-stripped">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__("storage/product.products")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.qt")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.ht")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.tva")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.tva_payed")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.ttc")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.taxes")) }}</th>
                                <th>{{ ucfirst(__("validation.attributes.profit")) }}</th>
                                @can('confirmSold',$sale)
                                    <th class="text-right">{{ ucfirst(__("validation.attributes.action")) }}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sale->quote->orders as $order)
                                <tr>
                                    <td>
                                        <a href="#">{{ $order->sold->purchase->product->name }}</a>
                                    </td>
                                    <td>{{ $order->sold->purchase->qt }}</td>
                                    <td>{{ $order->ht }}</td>
                                    <td>{{ $order->tva }}</td>
                                    <td>{{ $order->tva_payed }}</td>
                                    <td>{{ $order->ttc }}</td>
                                    <td>{{ $order->is }}</td>
                                    <td>{{ $order->profit }}</td>
                                    @can('confirmSold',$sale)
                                        <td class="text-right">
                                            {{ Form::open(['method'=>'delete','url'=> route('sold.destroy',['sale' => $sale,'sold' => $order->sold])]) }}
                                            <button type="submit" class="btn btn-danger"><i
                                                        class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}
                                            </button>
                                            {{ Form::close() }}
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="delete_sale{{ $sale->id }}" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ 'vente' }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('pages.diver.sure') }}</p>
                        {!! __('storage/product.modal_delete') !!}
                        <div class="m-t-20"><a href="#" class="btn btn-default"
                                               data-dismiss="modal">{{ __('validation.attributes.close') }}</a>
                            <span onclick="event.preventDefault();document.getElementById('{{ 'delete-sale-' . $sale->id }}').submit()"
                                  class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                            {{ Form::open(['method' => 'DELETE','url' => route('sale.destroy',compact('sale')),'id' => 'delete-sale-' . $sale->id ]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop