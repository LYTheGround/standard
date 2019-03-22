@extends('layouts.app')
@section('page-title')
    {{ __('purchase/purchase.add') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ __('purchase/purchase.add') }}</h4>
            </div>
        </div>
        <div class="card-box">
            {{ Form::open(['url' => route('purchase.store',compact('buy'))]) }}
            <div class="row">
                <div class="col-xs-7">
                    <div class="form-group">
                        <div class="form-focus">
                            <select name="product" title="product"
                                    id="product"
                                    class="form-control select-deal"
                                    required>
                                <option disabled selected value>{{ __('storage/product.products') }}</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                            data-image="{{ (isset($product->imgs[0]->img)) ? asset('storage/' . $product->imgs[0]->img) : asset('img/placeholder.jpg') }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="col-xs-5">
                    @include('form.number',[
                    'name'  => 'qt',
                    'title' => __('validation.attributes.qt'),
                    'value' => null
                    ])
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">
                       <i class="fa fa-plus"></i> {{ __('purchase/purchase.add') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="row">
            @include('trade.buy.purchase._list')
        </div>

    </div>
@stop