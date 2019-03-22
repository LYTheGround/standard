@extends('layouts.app')
@section('page-title')
    {{ strtoupper($product->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-b-30">
            <div class="col-xs-12 text-right">
                <a href="{{ route('product.edit',compact('product')) }}" class="btn btn-primary">
                    <i class="fa fa-edit"></i> {{ __('validation.attributes.edit') }}
                </a>
                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete_product{{ $product->id }}">
                    <i class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}
                </a>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="">
                        <div class="proimage-wrap">
                            <div class="pro-image" id="pro_popup">
                                <a href="#" title="{{ $product->name }}">
                                    <img class="img-responsive"
                                         src="{{(isset($product->imgs[0])) ? asset('storage/'.$product->imgs[0]->img) : asset('img/placeholder.jpg') }}"
                                         alt="{{ $product->name }}" title="{{ $product->name }}">
                                </a>
                            </div>
                            <ul class="proimage-thumb">
                                @foreach($product->imgs as $img)
                                    <li>
                                        <a href="{{asset('storage/'.$img->img)}}"><img
                                                    src="{{asset('storage/'.$img->img)}}" alt="{{ $product->name }}" title="{{ $product->name }}"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="product-info">
                        <h2>{{$product->name}}</h2>
                        <p>
                            @if((int) $product->qt > (int) $product->min_qt)
                                <span class="label label-success-border">{{ strtoupper(__('validation.attributes.in_stock')) }}</span>
                            @elseif((int) $product->qt == (int) $product->min_qt)
                                <span class="label label-warning-border text-primary">{{ strtoupper(__('validation.attributes.just_stock')) }}</span>
                            @elseif((int)$product->qt < (int) $product->min_qt and (int) $product->qt > 0)
                                <span class="label label-warning-border">{{ strtoupper(__('validation.attributes.low_stock')) }}</span>
                            @else
                                <span class="label label-danger-border">{{ strtoupper(__('validation.attributes.out_stock')) }}</span>
                            @endif
                        </p>
                        <p><b>{{__('validation.attributes.ref')}}</b> : {{ $product->ref }}</p>
                        <p><b>{{__('validation.attributes.size')}} : </b> {{ ($product->size) ?: 'inconnu' }}</p>
                        <p><b>{{__('validation.attributes.qt')}} : </b> {{ $product->qt . ' u' }}</p>
                        <p><b>{{__('validation.attributes.min_qt')}} : </b> {{ $product->min_qt . ' u' }}</p>
                        <p><b>{{__('validation.attributes.tva')}} : </b> {{$product->tva === 0 ? 'exonérer' : $product->tva.'%'  }}</p>
                        <p><b>{{ucfirst(__('validation.attributes.amount'))}} : </b> {{ ($product->amount) ?: '0' }} ~M TTC</p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#product_desc" data-toggle="tab">{{ ucfirst(__('validation.attributes.description')) }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="product_desc">
                            <div class="product-content">
                                <p class="text-justify">
                                    {{ ($product->description) ?: __('validation.attributes.inconnu') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('storage.product._destroy',compact('product'))
@stop