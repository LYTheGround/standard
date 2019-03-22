<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Http\Requests\Trade\BuyRequest;
use App\Trade;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BuyController extends Controller
{

    public function liste(Trade $trade)
    {
        if(isset($_GET['star']) && isset($_GET['end']) && !empty($_GET['end']) && !empty($_GET['star'])){
            $star = Carbon::parse($_GET['star'])->format('Y-m-d 00:00:00');
            $end = Carbon::parse($_GET['end'])->format('Y-m-d 23:59:59');
            if($star < $end){
                $buys = $trade->where([
                    ['company_id',auth()->user()->member->company->id],
                    ['buy',true],
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

        $buys = $trade->listBuy();

        return view('trade.buy.index', compact('buys'));

    }

    public function create()
    {

        return view('trade.buy.create');

    }

    public function store(BuyRequest $request, Trade $trade)
    {

        session()->flash('success',__('buy/buy.stored'));

        return redirect()->route('purchase.create', [
            'buy'   => $trade->onStore($request->date, true)
        ]);

    }

    public function show(Trade $buy)
    {

        return (auth()->user()->can('view', $buy))

            ? view('trade.buy.show', compact('buy'))

            : abort('404');

    }

    public function destroy(Trade $buy)
    {

        if (auth()->user()->can('view', $buy)) {

            if (auth()->user()->can('deleteBuy', $buy)) {

                $buy->delete();

                session()->flash('status', __('buy/buy.deleted'));

                return redirect()->route('buy.index');

            }

            session()->flash('danger', __('buy/buy.defence_delete'));

            return redirect()->route('buy.show',compact('buy'));

        }

        session()->flash('danger', __('buy/buy.access_danger'));

        return redirect()->route('buy.show', compact('buy'));

    }
}
