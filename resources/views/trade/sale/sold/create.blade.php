@extends('layouts.app')
@section('page-title')
    create sold
@stop
@section('content')
    <div class="content container-fluid">
        <div class="card-box">
            <div class="row">
                {{ Form::open(['url' => route('sold.list',compact('sale')),'id' => 'form_sold']) }}
                <div class="col-xs-12">
                    <div class="col-xs-7">
                        <div class="form-group">
                            <div class="form-focus">
                                <label for="product" class="control-label">Taper le nom du produit</label>
                                <input type="text" name="product" class="form-control" id="product-search"
                                       placeholder="product" required>
                            </div>
                        </div>
                        @if($errors->has('product'))
                            <span class="text-danger">{{ $errors->first('product') }}</span>
                        @endif
                    </div>
                    <div class="col-xs-5 text-right">
                        <button type="submit" class="btn btn-success">recherche</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
        <div class="row" id="list-purchase"></div>
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
        <div class="row">
            <div class="card-box">
                <div class="card-title">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            @can('confirmSold',$sale)
                                <a href="{{ route('sold.confirm',compact('sale')) }}" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Confirm
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
                                    <td>{{ $order->sold->qt }}</td>
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
    </div>
    <script type="text/javascript">
        $('body').on('submit', '#form_sold', function (e) {

            e.preventDefault()
            let $product = $('#form-sold #product-search').val();
            let $url = $('#form-sold').attr('action')
            let $token = $('input[name="_token"]').val();
            $.ajax({
                method: 'POST',
                url: $url,
                data: {"_token": $token, "product": $product},
                error: function (data) {
                    console.log(data)
                },
                success: function (data) {
                    $('#list-purchase').html(data);
                }
            })
        })
    </script>
@stop
