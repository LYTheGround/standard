<div class="card-box">
    <div class="row">
        <div class="col-xs-12 text-right">

            @if(!$buy->purchase)
                @if(!request()->is('buy/*/purchase'))
                    <a href="{{ route('purchase.create',compact('buy')) }}"
                       class="btn btn-sm btn-primary">{{ __('purchase/purchase.add') }}</a>
                @endif
                @if(isset($buy->purchases[0]))
                    <a href="#" onclick="event.preventDefault();document.getElementById('confirmed').submit();"
                       class="btn btn-sm btn-success">{{ __('purchase/purchase.confirm') }}</a>
                @endif
            @else
                @can('deleteConfirmPurchase',$buy)
                    <a href="#" onclick="event.preventDefault();document.getElementById('not_confirmed').submit();"
                       class="btn btn-sm btn-danger">{{ __('purchase/purchase.not_confirm') }}</a>
                @endcan
            @endif
            {{ Form::open(['url' => route('purchase.confirmed',compact('buy')), 'id' => 'confirmed']) }}
            {{ Form::close() }}
            {{ Form::open(['method' => 'PUT','url' => route('purchase.not_confirmed',compact('buy')), 'id' => 'not_confirmed']) }}
            {{ Form::close() }}
        </div>
    </div>
    <div class="row">
        <div class="card-block">
            <div class="table-responsive">
                <table class="display table dataTable table-stripped">
                    <thead>
                    <tr>
                        <th>{{ ucfirst(__("validation.attributes.name")) }}</th>
                        <th class="text-center">{{ ucfirst(__("validation.attributes.qt")) }}</th>
                        @if(!$buy->purchased)
                            <th class="text-right">{{ ucfirst(__("validation.attributes.action")) }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($buy->purchases as $purchase)
                        <tr>
                            <td>
                                <img src="{{ (isset($purchase->product->imgs[0])) ? asset('storage/' . $purchase->product->imgs[0]->img) : asset('img/placeholder.jpg') }}"
                                     alt="{{ $purchase->product->name }}" class="avatar">
                                <a href="#">{{ $purchase->product->name }}</a>
                            </td>
                            <td class="text-center">{{ $purchase->qt }}</td>
                            @if(!$buy->purchased)
                                <td class="text-right">
                                    {{ Form::open(['method' => "DELETE", 'url' => route('purchase.destroy',['buy' => $buy, 'purchase' => $purchase])]) }}
                                    <button type="submit"
                                            class="btn btn-sm btn-danger">{{ __('validation.attributes.delete') }}</button>
                                    {{ Form::close() }}
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