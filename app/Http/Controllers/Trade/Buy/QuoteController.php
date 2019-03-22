<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Http\Requests\Trade\QuoteRequest;
use App\Order;
use App\Quote;
use App\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{

    public function create(Trade $buy)
    {

        return (auth()->user()->can('view', $buy))

            ? view('trade.buy.quote.create', [
                'buy'   => $buy,
                'deals' => auth()->user()->deals()
            ])

            : abort(404);

    }

    public function store(QuoteRequest $request, Trade $buy, Quote $quote, Order $order)
    {

        $this->authorize('view', $buy);

        session()->flash('status', "Le devi a été Créer");

        return redirect()->route('buy.quote.show', [
            'buy' => $buy,
            'quote' => $quote->onStore($request, $buy, $order)
        ]);

    }

    public function show(Trade $buy, Quote $quote)
    {

        return (auth()->user()->can('view', $buy))

            ? view('trade.buy.quote.show', compact('buy', 'quote'))

            : abort(404);

    }

    public function destroy(Trade $buy, Quote $quote)
    {

        $this->authorize('view',$buy);
        if (!$buy->quoted) {

            $quote->onDelete($buy);

            session()->flash('status', 'le devi a été Supprimé');

            return redirect()->route('buy.show', compact('buy'));
        }

        session()->flash('danger', 'supprimé la confirmation du devi');

        return back();
    }

    public function confirmed(Trade $buy)
    {

        $this->authorize('view',$buy);

        $buy->onStoreQuote();

        session()->flash('status','Ce devi a été Confirmer');

        return redirect()->route('buy.show', compact('buy'));
    }

    public function notConfirmed(Trade $buy)
    {

        $this->authorize('view',$buy);

        $buy->onDeleteQuote();

        session()->flash('status', 'La confirmation de ce devi a été Supprimé');

        return redirect()->route('buy.show', compact('buy'));
    }

    public function selected(Trade $buy, Quote $quote)
    {

        $this->authorize('view',$buy);

        $quote->onSelected($buy);

        session()->flash('status', 'Le devi a été Sélectionné');

        return redirect()->route('buy.show', compact('buy'));

    }
}
