@extends('layouts.app')
@section('page-title')
    Term
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 text-right">
                @if(!$term->payed_at)
                    {{ Form::open(['url' => route('term.payment',compact('term'))]) }}
                    <button type="submit" class="btn btn-success">Payment</button>
                    {{ Form::close() }}
                    @else
                    {{ Form::open(['method' => 'DELETE','url' => route('term.payment.delete',compact('term'))]) }}
                    <button type="submit" class="btn btn-danger">delete Payment</button>
                    {{ Form::close() }}

                @endif
            </div>
        </div>
    </div>
@stop