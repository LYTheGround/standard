<div class="panel card-box activity-panel">
    <div class="row">
        @foreach($purchaseds as $purchased)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="product">
                    <div class="product-inner">
                        <img alt="alt" src="{{ asset('img/product/product-01.jpg') }}">
                        <div class="cart-btns">
                            <a href="{{ route('product.show',['product' => $purchased->slug]) }}"
                               class="btn btn-info addcart-btn">Access</a>
                            @if($purchased->qt_offer > 0)
                                @if($purchased->offer == 0)
                                    <a href="{{ route('sale.release',['purchase' => $purchased->id,'sale'=> $trade]) }}"
                                       class="btn btn-warning proedit-btn">{{ __('pages.trade.sale.release.btn') }}</a>
                                @else
                                        <a href="#" class="btn btn-primary proedit-btn add-product"
                                       data-target="{{'#add-product-' . $purchased->id}}">{{ ucfirst(__('validation.attributes.add')) }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="pro-desc">
                        <h5><a href="#">{{ $purchased->name }}</a></h5>
                        <span class="text-dark">{{ ($purchased->description) ? substr($purchased->description,0,10) . '...' : ''  }}</span>
                        <div class="price"><sup>{{ __('validation.attributes.buy_price') }}</sup> {{ $purchased->pu }}<b>
                                ~M</b></div>
                        <div class="price">
                            <sup>{{ __('validation.attributes.storeLeft') }}</sup>: {{ $purchased->qt_offer }}</div>
                        <div class="price">
                            <sup>{{ __('validation.attributes.offerLeft') }}</sup>: {{  $purchased->offer}}</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            {{ Form::open(['url'=> route('sold.store',compact('trade')),'id'=>'add-product-' . $purchased->id,'class'=>'form-horizontal form-bc','style'=>'display: none;']) }}
                            <div class="form-group text-center">
                                <div class="col-xs-12 m-b-5">
                                    {{ Form::number('qt',null,['class'=>'form-control','placeholder' => __('validation.attributes.qt'),'title' =>  __('validation.attributes.qt'),'min'=>1, 'max'=> $purchased->offer,'required']) }}
                                </div>
                                <div class="col-xs-12 m-b-5">
                                    {{ Form::number('pu',null,['class'=>'form-control','placeholder' => __('validation.attributes.pu'),'title' =>  __('validation.attributes.pu'), 'step'=>"0.01",'min'=>1,'required']) }}
                                </div>
                                <div class="col-xs-12 text-right">
                                    {{ Form::number('purchased_id',$purchased->id,['style'=>'display: none;','required']) }}

                                    {{ Form::submit(__('validation.attributes.add'),['class'=>'btn btn-primary']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>