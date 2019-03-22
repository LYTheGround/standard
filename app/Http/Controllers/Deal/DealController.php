<?php

namespace App\Http\Controllers\Deal;

use App\Deal;
use App\Http\Requests\Deal\DealRequest;
use App\Info_box;
use App\Notifications\Deal\CreateDealNotification;
use App\Notifications\Deal\UpdateDealNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class DealController extends Controller
{

    public function index(Deal $deal)
    {

        return view('deal.index', ['deals' => $deal->liste()]);

    }


    public function create()
    {

        return view('deal.create');

    }


    public function store(DealRequest $request, Deal $deal, Info_box $box)
    {

        $deal = $deal->onStore($request, $box);

        session()->flash('status', __('deal/deal.stored'));

        Notification::send(auth()->user()->colleagues(), new CreateDealNotification($deal));

        return redirect()->route('deal.show', compact('deal'));

    }


    public function show(Deal $deal)
    {

        $this->authorize('view',$deal);

        return view('deal.show', compact('deal'));

    }


    public function edit(Deal $deal)
    {

        $this->authorize('update',$deal);

        return view('deal.edit', compact('deal'));

    }


    public function update(DealRequest $request, Deal $deal)
    {

        $this->authorize('update',$deal);

        $deal = $deal->onUpdate($request, $deal);

        session()->flash('status', __('deal/deal.updated'));

        Notification::send(auth()->user()->colleagues(), new UpdateDealNotification($deal));

        return redirect()->route('deal.show', compact('deal'));

    }

    public function destroy(Deal $deal)
    {

        $this->authorize('update',$deal);

        $deal->onDelete();

        session()->flash('status', __('deal/deal.deleted'));

        return redirect()->route('deal.index');

    }
}
