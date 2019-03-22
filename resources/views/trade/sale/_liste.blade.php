<div class="card-box">
    <div class="card-block">
        <div class="table-responsive">
            <table class="display table_desc datatable table table-stripped">
                <thead>
                <tr>
                    <th>{{ ucfirst(__("validation.attributes.progress")) }}</th>
                    <th class="text-center">{{ __('validation.attributes.ht') }}</th>
                    <th class="text-center">{{ __('validation.attributes.tva') }}</th>
                    <th class="text-center">{{ __('validation.attributes.tva_payed') }}</th>
                    <th class="text-center">{{ __('validation.attributes.ttc') }}</th>
                    <th class="text-right">{{ ucfirst(__("validation.attributes.month")) }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)

                    <tr>
                        <td>
                            <a href="{{ route('sale.show',compact('sale')) }}">
                                <div class="progress progress-xs progress-striped" style="background: gray;">
                                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip"
                                         title="{{ $sale->progress }}%" style="width: {{ $sale->progress }}%"></div>
                                </div>
                                <div class="text-center">
                                    <span>{{ $sale->progress }}%</span>
                                </div>
                            </a>
                        </td>
                        <td class="text-center">{{ ($sale->quote) ? $sale->quote->ht : 0 }}</td>
                        <td class="text-center">{{ ($sale->quote) ? $sale->quote->tva : 0 }}</td>
                        <td class="text-center">{{ ($sale->quote) ? $sale->quote->tva_payed : 0 }}</td>
                        <td class="text-center">{{ ($sale->quote) ? $sale->quote->ttc : 0 }}</td>
                        <td class="text-right">{{ (isset($sale->terms[0]))  ? \Carbon\Carbon::parse($sale->terms[0]->month->month)->format('m-Y') : __('validation.attributes.inconnu') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>