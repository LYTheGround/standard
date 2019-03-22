@extends('layouts.app')
@section('page-title')
    Créer une nouvelle vente
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">Créer une nouvelle vente</h4>
            </div>
            <div class="row card-box">
                {{ Form::open(['route' => 'sale.store']) }}
                <div class="row">
                    <div class="col-xs-12">
                        @include('form.date',[
                        'name' => 'date',
                        'title' => __('buy/buy.create_date'),
                        'value' => (old('date')) ? old('date') : \Carbon\Carbon::now(),
                        'attributes' => ['required']
                        ])
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="form-focus">
                                <select name="deal" title="deal"
                                        id="deal"
                                        class="form-control select-deal"
                                        required>
                                    <option disabled selected value>{{ __('deal/deal.deals') }}</option>
                                    @foreach($deals as $deal)
                                        <option value="{{ $deal->id }}"
                                                data-image="{{ ($deal->infoBox->brand) ? asset('storage/' . $deal->infoBox->brand) : asset('img/placeholder.jpg') }}">{{ $deal->infoBox->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> créer la vente
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop