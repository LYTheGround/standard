<?php

namespace App\Http\Controllers\Money;

use App\Http\Requests\Money\UnloadRequest;
use App\Month;
use App\Unload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UnloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Unload $unload
     * @return \Illuminate\Http\Response
     */
    public function index(Unload $unload)
    {
        if(isset($_GET['star']) && isset($_GET['end']) && !empty($_GET['end']) && !empty($_GET['star'])){
            $star = Carbon::parse($_GET['star'])->format('Y-m-d 00:00:00');
            $end = Carbon::parse($_GET['end'])->format('Y-m-d 23:59:59');
            if($star < $end){
                $unloads = $unload->where([
                    ['company_id',auth()->user()->member->company->id],
                    ['date','>',$star],
                    ['date','<', $end]

                ])->get();
            }
            else{
                $unloads = $unload->listUnload();
                session()->flash('danger','la date de départ doit être inférieur a la date de fin');
            }

        }else{
            $unloads = $unload->listUnload();
        }
        return view('money.unload.index', compact('unloads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('money.unload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UnloadRequest|Request $request
     * @param Unload $unload
     * @return \Illuminate\Http\Response
     */
    public function store(UnloadRequest $request,Unload $unload)
    {
        $justify = $request->file('justify')->store('unloads');
        $unload = $unload->onStore($justify,$request->all(['prince','date','on','description']),new Month());
        return redirect()->route('unload.show',compact('unload'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unload  $unload
     * @return \Illuminate\Http\Response
     */
    public function show(Unload $unload)
    {
        return view('money.unload.show',compact('unload'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unload  $unload
     * @return \Illuminate\Http\Response
     */
    public function edit(Unload $unload)
    {
        return view('money.unload.edit',compact('unload'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UnloadRequest|Request $request
     * @param  \App\Unload $unload
     * @return \Illuminate\Http\Response
     */
    public function update(UnloadRequest $request, Unload $unload)
    {
        // update justify
        if($request->file('justify')){
            Storage::disk('public')->delete($unload->justify);
            $justify = $request->file('justify')->store('unloads');
        }else{
            $justify = $unload->justify;
        }
        $unload->onUpdate($justify,$request->all(['prince','date','on','description']));

        return redirect()->route('unload.show',compact('unload'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unload  $unload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unload $unload)
    {
        $unload->onDelete();
        return redirect()->route('unload.index');
    }
}
