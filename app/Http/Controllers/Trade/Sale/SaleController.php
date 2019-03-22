<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Purchase;
use App\Trade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{

    public function liste(Trade $trade)
    {
        if(isset($_GET['star']) && isset($_GET['end']) && !empty($_GET['end']) && !empty($_GET['star'])){
            $star = Carbon::parse($_GET['star'])->format('Y-m-d 00:00:00');
            $end = Carbon::parse($_GET['end'])->format('Y-m-d 23:59:59');
            if($star < $end){
                $buys = $trade->where([
                    ['company_id',auth()->user()->member->company->id],
                    ['buy',false],
                    ['updated_at','>',$star],
                    ['updated_at','<', $end]

                ])->get();
            }
            else{
                $buys = $trade->listBuy();
                session()->flash('danger','la date de départ doit être inférieur a la date de fin');
            }

        }else{
            $buys = $trade->listBuy();
            session()->flash('danger','vars obligatoire');
        }
        return view('trade.buy.index', compact('buys'));
    }

    public function index(Trade $trade)
    {

        $sales = $trade->listSale();

        return view('trade.sale.index',compact('sales'));
    }

    public function create()
    {
        $deals = auth()->user()->member->company->deals()->with(['infoBox'])->get();

        return view('trade.sale.create',compact('deals'));
    }

    public function store(Request $request,Trade $trade)
    {
        $sale = $trade->onStore($request->date);
        $sale->quotes()->create([
            'selected'      => true,
            'deal_id'       => $request->deal
        ]);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function show(Trade $sale)
    {
        return view('trade.sale.show',compact('sale'));
    }

    public function destroy(Trade $sale)
    {
        $this->authorize('view',$sale);
        if(!$sale->buy){
            if($sale->sold){
                session()->flash('danger','supprimé le bon de commande avant de supprimé cette vente');
                return back();
            }
            foreach ($sale->solds as $sold){
                $sold->onDelete($sale);
            }
            $sale->delete();
            session()->flash('status','la vente a bien été supprimé');
        }
        return redirect()->route('sale.index');

    }

    public function fc(Trade $sale)
    {
        //dd($sale->quote->orders[0]->sold->purchase->product->name);
        return view('trade.sale.fc',compact('sale'));
    }
    public function bl(Trade $sale)
    {
        //dd($sale->quote->orders[0]->sold->purchase->product->name);
        return view('trade.sale.bl',compact('sale'));
    }



}
