@extends('layouts.app')
@section('page-title')
    Dashboard
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel member-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ strtoupper(__('rh/member.list')) }}</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="contact-list">
                            @foreach(auth()->user()->member->colleagues() as $member)
                                <li>
                                    <div class="contact-cont">
                                        <div class="pull-left user-img m-r-10">
                                            <a href="#" title="John Doe"><img
                                                        src="{{ ($member->info->face) ? asset('storage/' . $member->info->face) : asset('img/user.jpg') }}"
                                                        alt=""
                                                        class="w-40 img-circle"><span
                                                        class="status online"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span
                                                    class="contact-name text-ellipsis">
                                                <a href="{{ route('member.show',compact('member')) }}">{{ $member->info->full_name }}</a>
                                            </span>
                                            <span class="contact-date">{{ $member->premium->category->category }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer text-center bg-white">
                        <a href="{{ route('member.index') }}" class="text-primary">View all Members</a>
                    </div>
                </div>
            </div>
            @if(isset($products[0]))
                <div class="col-sm-6">
                    <div class="panel member-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('storage/product.list')) }}</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="contact-list">
                                @foreach($products as $product)
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="#" title="{{ $product->name }}"><img
                                                            src="{{ (isset($product->imgs[0])) ? asset('storage/' . $product->imgs[0]->img) : asset('img/placeholder.jpg') }}"
                                                            alt="{{ $product->name }}"
                                                            class="avatar"></a>
                                            </div>
                                            <div class="contact-info">
                                            <span class="contact-name text-ellipsis">
                                                <a href="{{ route('product.show',compact('product')) }}">{{ $product->name }}</a>
                                            </span>
                                                <span class="contact-date">{{ '#REF-' . $product->ref }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-footer text-center bg-white">
                            <a href="{{ route('product.index') }}"
                               class="text-primary">{{ __('storage/product.view_all') }}</a>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($deals[0]))
                <div class="col-sm-6">
                    <div class="panel member-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('deal/deal.list')) }}</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="contact-list">
                                @foreach($deals as $deal)
                                    <li>
                                        <div class="contact-cont ">
                                            <div class="pull-left user-img m-r-10 ">
                                                <a href="#" title="{{ $deal->infoBox->name }}" class="avatar">
                                                    {{ substr($deal->infoBox->name,0,1) }}</a>
                                            </div>
                                            <div class="contact-info">
                                            <span class="contact-name text-ellipsis">
                                                <a href="{{ route('deal.show',compact('deal')) }}">{{ $deal->infoBox->name }}</a>
                                            </span>
                                            <span class="contact-date">{{ $deal->infoBox->speaker }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-footer text-center bg-white">
                            <a href="{{ route('deal.index') }}"
                               class="text-primary">{{ __('deal/deal.view_all') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop