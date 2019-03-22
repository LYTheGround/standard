<?php

namespace App\Http\Controllers\Trade;

use App\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{
    
    public function onDeleteStore(Trade $trade)
    {
        $trade->onDeleteStored();
        return back();
    }

    public function onStoreStore(Trade $trade)
    {
        $trade->onStoreStored();
        return back();
    }

    public function onDeleteDelivery(Trade $trade)
    {
        $trade->onDeleteDelivery();
        return back();
    }

    public function onStoreDelivery(Trade $trade)
    {
        $trade->onStoreDelivery();
        return back();
    }

    public function onStoreInvoice(Request $request, Trade $trade)
    {
        $trade->onStoreInvoice($request->invoice);
        return back();
    }

    public function onDeleteInvoice(Request $request, Trade $trade)
    {
        $trade->onDeleteInvoice();
        return back();
    }

    public function onStoreForm(Request $request, Trade $trade)
    {
        $trade->onStoreForm($request->formed);
        return back();
    }

    public function onDeleteForm(Request $request, Trade $trade)
    {
        $trade->onDeleteForm();
        return back();
    }

}
