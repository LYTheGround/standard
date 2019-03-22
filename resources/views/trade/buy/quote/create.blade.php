@extends('layouts.app')
@section('page-title')
    create Quote
@stop
@section('content')

    <div class="content container-fluid">

        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">Créer un devi</h4>
            </div>
        </div>

        <div class="card-box">

            <div class="row">
                {{ Form::open(['url' => route('buy.quote.store',compact('buy'))]) }}
                <div class="col-xs-12">
                    <div class="form-group">
                        <select name="deal" title="deal" class="form-control select-deal" required id="deal">
                            <option disabled selected value>deals</option>
                            @foreach($deals as $deal)
                                <option value="{{ $deal->id }}"
                                        data-image="{{ ($deal->infoBox->brand)
                                        ? asset('storage/' . $deal->infoBox->brand)
                                        : asset('img/placeholder.jpg') }}">{{ $deal->infoBox->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('deal'))
                        <span class="text-danger">{{ $errors->first('deal') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="display table dataTable table-stripped">
                                    <thead>
                                    <tr>
                                        <th>{{ ucfirst(__("storage/product.products")) }}</th>
                                        <th>{{ ucfirst(__("validation.attributes.qt")) }}</th>
                                        <th>{{ ucfirst(__("validation.attributes.pu")) }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($buy->purchases as $purchase)
                                        <tr>
                                            <td>
                                                <h6>
                                                @if(isset($purchase->product->imgs[0]->img))
                                                    <img src="{{ asset('storage/' . $purchase->product->imgs[0]->img) }}"
                                                    class="avatar">
                                                    @else
                                                    <span class="avatar">{{ substr($purchase->product->name,0,1) }}</span>
                                                @endif
                                                    <a href="{{ route('product.show',['product' => $purchase->product]) }}">{{ $purchase->product->name }}</a>
                                                </h6>
                                            </td>
                                            <td>
                                                {{ $purchase->qt }}
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-focus">
                                                        {{ Form::label("pu[$purchase->id]", ucfirst(__('validation.attributes.pu')), ['class' => 'control-label']) }}
                                                        {{ Form::number("pu[$purchase->id]", null, ['class' => 'form-control form-floating','step'=>"0.1",'required']) }}
                                                    </div>
                                                    @if($errors->has("pu.$purchase->id"))
                                                        <span class="text-danger">{{ $errors->first("pu.$purchase->id") }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-right">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Créer
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


                {{ Form::close() }}
            </div>

        </div>

    </div>
@stop