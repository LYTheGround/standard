<div class="card-box">
    <div class="row">
        <div class="col-xs-12 text-right">
            @cannot('deleteConfirmQuote',$buy)
                <a href="{{ route('buy.quote.create',compact('buy')) }}" class="btn btn-sm btn-primary">Ajouté</a>

            @endcannot
            @can('confirmQuote',$buy)
                <a href="{{ route('buy.quote.confirmed',compact('buy')) }}"
                   class="btn btn-sm btn-success">Confirmé</a>
            @endcan
            @can('deleteConfirmQuote',$buy)
                <a href="{{ route('buy.quote.not_confirmed',compact('buy')) }}"
                   class="btn btn-sm btn-danger">supprimé la confirmation</a>
            @endcan

        </div>
    </div>
    <div class="row">
        <div class="card-block">
            <div class="table-responsive">
                <table class="display table dataTable table-stripped">
                    <thead>
                    <tr>
                        <th>{{ ucfirst(__("validation.attributes.quotes")) }}</th>
                        <th>{{ ucfirst(__("deal/deal.deals")) }}</th>
                        <th>{{ ucfirst(__("validation.attributes.ht")) }}</th>
                        <th>{{ ucfirst(__("validation.attributes.tva")) }}</th>
                        <th>{{ ucfirst(__("validation.attributes.ttc")) }}</th>
                        <th>{{ ucfirst(__("validation.attributes.selected")) }}</th>
                        @if(count($buy->quotes) > 1)
                            <th class="text-right">{{ ucfirst(__("validation.attributes.action")) }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($buy->quotes as $quote)
                        <tr>
                            <td>
                                <a href="{{ route('buy.quote.show',compact('buy','quote')) }}">Devi</a>
                            </td>
                            <td>
                                <a href="#">{{ $quote->deal->infoBox->name }}</a>
                            </td>
                            <td>{{ $quote->ht }}</td>
                            <td>{{ $quote->tva }}</td>
                            <td>{{ $quote->ttc }}</td>
                            <td class="text-center">{{ ($quote->selected) ? 'selected' : '' }}</td>
                            @if(count($buy->quotes) > 1)
                                <td class="text-center">
                                    @if(!$quote->selected)
                                        <a href="{{ route('buy.quote.selected',compact('quote','buy')) }}"
                                           class="btn btn-primary">selected</a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>