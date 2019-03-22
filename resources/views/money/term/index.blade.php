@extends('layouts.app')
@section('page-title')
    liste des échéances
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-t-50">
            <div class="card-box">
                <div class="row">
                    {{ Form::open(['method' => 'GET', 'url' => route('term.list')]) }}
                    <div class="col-xs-4">
                        @include('form.date',['name' => 'star','title' => 'De','value' => (isset($_GET['star'])) ? $_GET['star'] : null,'attributes' => ['required']])
                    </div>
                    <div class="col-xs-4">
                        @include('form.date',['name' => 'end','title' => 'à','value' =>   (isset($_GET['end'])) ? $_GET['end'] : null,'attributes' => ['required']])
                    </div>
                    <div class="col-xs-4 text-right">
                        <button type="submit" class="btn btn-primary">search</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="display table dataTable table-stripped">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__("deal/deal.deals")) }}</th>
                                <th>{{ ucfirst(__("montant")) }}</th>
                                <th>{{ ucfirst(__("créer par")) }}</th>
                                <th>{{ ucfirst(__("date de payment")) }}</th>
                                <th>{{ ucfirst(__("payed_at")) }}</th>
                                <th>{{ ucfirst(__("recever payment")) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($terms as $term)
                                <tr>
                                    <td>
                                        <a href="#" class="avatar"
                                           title="{{ $term->payer->infoBox->name }}">{{ strtoupper(substr($term->payer->infoBox->name,0,1))  }}</a>
                                        <h2>
                                            <a href="{{ route('deal.show',['deal' => $term->payer]) }}">{{ $term->payer->infoBox->name  }}</a>
                                        </h2>
                                    </td>
                                    <td><a href="{{ route('term.show',compact('term')) }}">{{ $term->payment }}</a></td>
                                    <td>{{ $term->creator->info->full_name }}</td>
                                    <td>{{ Carbon\Carbon::parse($term->date)->format('d-m-Y') }}</td>
                                    <td>{{ ($term->payed_at) ? Carbon\Carbon::parse($term->payed_at)->format('d-m-Y') : 'impayé' }}</td>
                                    <td>{{ ($term->payed) ? $term->payed->info->full_name : 'inconnu' }}</td>
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