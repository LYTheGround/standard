@extends('layouts.app')
@section('page-title')
    {{ __('storage/product.list') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-b-30">
            <div class="col-xs-7">
                <h4 class="page-title">{{ __('storage/product.list') }}</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> {{ __('storage/product.create') }}
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
                                <th>{{ __('validation.attributes.qt') }}</th>
                                <th class="hidden-xs hidden-sm">{{ __('validation.attributes.tva') }}</th>
                                <th class="hidden-xs hidden-sm">{{ __('validation.attributes.status') }}</th>
                                <th class="text-right hidden-xs hidden-sm">{{ __('validation.attributes.min_qt') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        @if(isset($product->imgs[0]))
                                            <img src="{{ asset('storage/' . $product->imgs[0]->img) }}" class="avatar"
                                                 alt="{{ $product->name }}" title="{{ $product->name }}">
                                        @else
                                            <a href="#" class="avatar"
                                               title="{{ $product->name }}">{{ strtoupper(substr($product->name,0,1))  }}</a>
                                        @endif
                                        <h2>
                                            <a href="{{ route('product.show',compact('product')) }}">{{ $product->name  }}</a>
                                            <span>#REF-{{ $product->ref }}</span>
                                            <small class="text-muted">{{ substr($product->description,0,15) }}</small>
                                        </h2>
                                    </td>
                                    <td>{{ $product->qt }}</td>
                                    <td class="hidden-xs hidden-sm">{{ $product->tva }}</td>
                                    <td class="hidden-xs hidden-sm">
                                        @if((int) $product->qt > (int) $product->min_qt)
                                            <span class="label label-success-border">{{ strtoupper(__('validation.attributes.in_stock')) }}</span>
                                        @elseif((int) $product->qt == (int) $product->min_qt)
                                            <span class="label label-warning-border text-primary">{{ strtoupper(__('validation.attributes.just_stock')) }}</span>
                                        @elseif((int)$product->qt < (int) $product->min_qt and (int) $product->qt > 0)
                                            <span class="label label-warning-border">{{ strtoupper(__('validation.attributes.low_stock')) }}</span>
                                        @else
                                            <span class="label label-danger-border">{{ strtoupper(__('validation.attributes.out_stock')) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-right hidden-xs hidden-sm">{{ $product->min_qt }}</td>
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