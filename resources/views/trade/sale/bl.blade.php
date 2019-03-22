@extends('layouts.app')
@section('page-title')
    {{ strtoupper(__('validation.attributes.fc')) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-5">
                <h4 class="page-title">{{ strtoupper(__('validation.attributes.fc')) }}</h4>
            </div>
            <div class="col-xs-7 text-right m-b-30">
                <div class="btn-group btn-group-sm">
                    <button onclick="printDiv('printMe')" class="btn btn-default"><i class="fa fa-print fa-lg"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="row" id="printMe">
            <div class="col-xs-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 m-b-20">
                                @if($sale->company->info_box->brand)
                                    <img src="{{ asset('storage/' . $sale->company->info_box->brand) }}" class="inv-logo" alt="{{ $sale->company->info_box->name }}" title="{{ $sale->company->info_box->name }}">
                                @endif
                                <h3>Bon de Livraison</h3>
                                <ul class="list-unstyled">
                                    <li><strong>{{ ucfirst($sale->company->info_box->name) }}</strong></li>
                                    <li>{{ ($sale->company->info_box->zip) ? $sale->company->info_box->zip . ', ' : '' }} {{ $sale->company->info_box->address }},</li>
                                    <li>{{ $sale->company->info_box->build . ', ' }}{{ ($sale->company->info_box->floor) ? 'étage : ' . $sale->company->info_box->floor . ', n° ' . $sale->company->info_box->apt_nbr . ',' :'' }}</li>
                                    <li>{{ $sale->company->info_box->city->city }}</li>
                                    <li>{{ $sale->company->info_box->emails[0]->email }}</li>
                                    <li>{{ $sale->company->info_box->tels[0]->tel }}</li>
                                    <li>{{ ucfirst(__('validation.attributes.licence')) }} : {{ $sale->company->info_box->licence }}</li>
                                    <li>{{ ucfirst(__('validation.attributes.ice')) }} : {{ $sale->company->info_box->ice }}</li>
                                </ul>
                            </div>
                            <div class="col-xs-6 m-b-20">
                                <div class="col-xs-12">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">{{ '#BL-' . $sale->ref }}</h3>
                                        <ul class="list-unstyled">
                                            <li>{{ ucfirst(__('validation.attributes.sale_date')) }} : <span>{{ Carbon\Carbon::parse($sale->terms[0]->created_at)->format('d/m/Y') }}</span></li>
                                            <li>{{ ucfirst(__('validation.attributes.due_at')) }} : <span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-right">
                                    <div class="col-md-12 col-lg-12 m-b-20 text-right">
                                        <h5>{{ ucfirst(__('validation.attributes.inv_to')) }} :</h5>
                                        <ul class="list-unstyled">
                                            <li>
                                                <h5><strong>{{ $sale->quote->deal->infoBox->name }}</strong></h5></li>
                                            <li>{{ ($sale->quote->deal->infoBox->zip) ? $sale->quote->deal->infoBox->zip . ', ' : '' }} {{ ($sale->quote->deal->infoBox->address) ?:'' }}</li>
                                            <li>{{ ($sale->quote->deal->infoBox->build) ? 'n° :' . $sale->quote->deal->infoBox->build . ', ' : ''}}{{ ($sale->quote->deal->infoBox->floor) ? ' ' . __('validation.attributes.floor') . ' : ' . $sale->quote->deal->infoBox->floor . ', n° ' . $sale->quote->deal->infoBox->apt_nbr . ',' :'' }}</li>
                                            <li>{{ $sale->quote->deal->infoBox->city->city }}</li>
                                            <li>{{ $sale->quote->deal->infoBox->tels[0]->tel }}</li>
                                            <li>{{ $sale->quote->deal->infoBox->emails[0]->email }}</li>
                                            <li>ICE : {{ ($sale->quote->deal->infoBox->ice) ? $sale->quote->deal->infoBox->ice : __('validation.attributes.inconnu') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produit</th>
                                    <th>DESCRIPTION</th>
                                    <th>PU</th>
                                    <th>QUANTITÉ</th>
                                    <th>TVA</th>
                                    <th>HT</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->quote->orders as $key => $order)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <h2>
                                                <span>{{ $order->sold->purchase->product->name }}</span>
                                                <span>#REF-{{ $order->sold->purchase->product->ref }}</span>
                                            </h2>
                                        </td>
                                        <td>{{ ($order->sold->purchase->product->description)? strtoupper(substr($order->sold->purchase->product->name,0,25)) . ' ...' : '' }}</td>
                                        <td>{{ $order->pu }}</td>
                                        <td>{{ $order->sold->purchase->qt }}</td>
                                        <td>{{ $order->ht }}</td>
                                        <td>{{ $order->tva }}</td>
                                        <td>{{ $order->ttc }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                </div>
                                <div class="col-sm-5">
                                    <div class="m-b-20">
                                        <h6>TOTAL</h6>
                                        <div class="table-responsive no-border">
                                            <table class="table m-b-0">
                                                <tbody>
                                                <tr>
                                                    <th>TOTAL HT :</th>
                                                    <td class="text-right">{{ $sale->quote->ht }}</td>
                                                </tr>
                                                <tr>
                                                    <th>TOTAL TVA:</th>
                                                    <td class="text-right">{{ $sale->quote->tva }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total :</th>
                                                    <td class="text-right text-primary">
                                                        <h5>{{ $sale->quote->ttc }}</h5></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@stop
