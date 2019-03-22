<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Http\Requests\Trade\SoldRequest;
use App\Order;
use App\Purchase;
use App\Sold;
use App\Trade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * @property  purchase
 */
class SoldController extends Controller
{
    private $purchase;

    public function create(Trade $sale)
    {
        return view('trade.sale.sold.create', compact('sale'));
    }

    private function validation(Request $request,Trade $trade)
    {
        if(!$request->purchased_id || !$request->pu || !$request->qt){
            return back()->withErrors(['product' => 'tous les champs sont obligatoire'])->withInput();
        }
        $purchase = Purchase::where('id',$request->purchased_id)->first();
        $this->purchase = $purchase;
        if(!$purchase){
            return back();
        }
        if($purchase){
           if($purchase->trade_id === $trade->id){
                if($purchase->offer < $request->qt){
                    return back()->withErrors(['product' => 'la quantité doit être inférieur ou égale a ' . $purchase->offer])->withInput();
                }
                if($request->pu < 0.01){
                    return back()->withErrors(['product' => 'le prix unitaire doit être supérieur ou égale a 0.1'])->withInput();
                }
           }
        }
        return null;
    }

    public function store(Request $request, Trade $trade,Sold $sold)
    {
        // purchased_id
        // qt
        // pu
        $this->authorize('view',$trade);
        if(!is_null($this->validation($request,$trade))){
            return back();
        }
        $sold = $sold->onStore($request,$trade,$this->purchase);
        $quote = $trade->quotes[0];

        $order = $this->purchase->orders->map(function ($query){
            if($query->quote()->where('selected',true)->first()){
                return $query;
            }
        })[0];
// quote
        // order
        $ht = $request->pu * $request->qt;
        $tva = (($this->purchase->product->tva * $ht ) / 100);
        $ttc = $ht + $tva;
        $tva_payed = $tva - (($order->tva_payed / $this->purchase->qt) * $request->qt);
        $profit = $ttc - (($order->ttc/$this->purchase->qt) * $request->qt) - $tva_payed;
        $is = ((auth()->user()->member->company->info_box->taxes * $profit)/100);

        $profit = $profit - $is;
        $quote->update([
            'ht'        => $quote->ht + $ht,
            'tva'       => $quote->tva + $tva,
            'tva_payed' => $quote->tva_payed + $tva_payed,
            'ttc'       => $quote->ttc + $ttc,
            'is'        => $quote->is + $is,
            'profit'    => $quote->profit + $profit
        ]);

        Order::create([
            'pu'        => $request->pu,
            'ht'        => $ht,
            'tva'       => $tva,
            'tva_payed' => $tva_payed,
            'ttc'       => $ttc,
            'is'        => $is,
            'profit'    => $profit,
            'sold_id'   => $sold->id,
            'quote_id'  => $quote->id
        ]);
        return redirect()->route('sold.create',compact('trade'));
    }

    public function liste(Request $request, Trade $trade)
    {

        $purchaseds = DB::table('purchases')
            ->join('products', 'products.id', '=', 'purchases.product_id')
            ->join('orders', 'purchases.id', '=', 'orders.purchase_id')
            ->join('quotes', 'quotes.id', '=', 'orders.quote_id')
            ->where('products.qt', '>', 0)
            ->where('products.name', 'LIKE', '%' . $request->product . '%')
            ->where('purchases.qt_offer', '>', 0)
            ->where('quotes.selected', '=', true)
            ->select('purchases.id as id', 'orders.pu as pu',
                'products.name as name', 'products.ref as ref', 'products.slug as slug', 'products.description as description',
                'purchases.offer as offer', 'purchases.qt_offer as qt_offer')
            ->get();

        return view('trade.sale.sold._product',compact('purchaseds','trade'));
    }

    public function destroy(Trade $trade, Sold $sold)
    {
        $order = $sold->order;

        $quote = $sold->order->quote;

        $quote->update([
            'ht'        => $quote->ht - $order->ht,
            'tva'       => $quote->tva - $order->tva,
            'tva_payed' => $quote->tva_payed - $order->tva_payed,
            'ttc'       => $quote->ttc - $order->ttc,
            'is'        => $quote->is - $order->is,
            'profit'    => $quote->profit - $order->profit
        ]);

        $order->delete();
        $sold->onDelete($trade);
        $sold->delete();

        return redirect()->route('sale.show',compact('trade'));
    }

    public function confirm(Trade $trade)
    {
        $this->authorize('view',$trade);
        $this->authorize('confirmSold',$trade);
        $trade->update([
            'sold' => auth()->user()->member->id,
            'sold_at' => Carbon::now(),
            'quoted' => auth()->user()->member->id,
            'quote_at' => Carbon::now(),
        ]);
        return redirect()->route('sale.show',compact('trade'));
    }

    public function destroyConfirm(Trade $trade)
    {
        $this->authorize('view',$trade);
        $this->authorize('deleteConfirmSold',$trade);
        $trade->update([
            'sold' => null,
            'sold_at' => null,
            'quoted' => null,
            'quote_at' => null,
        ]);
        return redirect()->route('sale.show',compact('trade'));
    }

    public function release(Trade $sale, Purchase $purchase)
    {

        $solds = $purchase->solds()->with(['trade'])->get();
         return view('trade.sale.release',['solds' => $solds]);
    }
}
