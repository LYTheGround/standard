<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Purchase;
use App\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function create(Trade $buy)
    {

        if (auth()->user()->can('view', $buy)) {

            $products = auth()->user()->member->company->products;

            return view('trade.buy.purchase.create', compact('products', 'buy'));

        }

        session()->flash('danger', __('buy/buy.access_danger'));

        return redirect()->route('buy.index');

    }

    public function store(Request $request, Trade $buy, Purchase $purchase)
    {
        return $purchase->onStore($request->all(['qt', 'product']), $buy)

            ? redirect()->route('purchase.create', compact('buy'))

            : abort(403);

    }

    public function destroy(Trade $buy, Purchase $purchase)
    {
        if (!$buy->purchased) {

            $purchase->delete();

            session()->flash('status', __('purchase/purchase.deleted'));

            return redirect()->route('purchase.create', compact('buy'));

        }

        session()->flash('danger', __('purchase/purchase.defence_delete'));

        return back();

    }

    public function confirmed(Trade $buy)
    {

        $this->authorize('view', $buy);

        $buy->onPurchased();

        session()->flash('status', __('confirmé avec succès'));

        return redirect()->route('buy.show', compact('buy'));
    }

    public function notConfirmed(Trade $buy)
    {

        $this->authorize('view', $buy);

        $buy->onDeletePurchased();

        session()->flash('status', __('la confirmation a été supprimé'));

        return redirect()->route('purchase.create', compact('buy'));

    }
}
