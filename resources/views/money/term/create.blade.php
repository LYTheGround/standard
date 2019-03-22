@extends('layouts.app')
@section('page-title')
    Create Term
@stop
@section('content')
    <div class="content container-fluid">
        <div class="card-box">
            <div class="row">
                {{ Form::open(['url' => route('buy.term.store',compact('trade')),'id'=> 'form_term']) }}
                <div class="row">
                    <div class="col-xs-12">
                        @include('form.date',[
                        'title' => 'date de paiement',
                        'name' => "date",
                        'value' => gmdate('Y-m-d'),
                        'attributes' => ['required']])

                    </div>
                </div>
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-primary">Ajouté</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop