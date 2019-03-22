<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $progress
 * @property bool|null $buy
 * @property integer $ref
 * @property integer|null $purchase
 * @property Carbon $purchased_at
 * @property Member $purchased
 * @property Quote $quote
 * @property Carbon $quoted_at
 * @property integer $quoted
 * @property integer|null $delivery
 * @property Carbon $delivered_at
 * @property Member $delivered
 * @property string|null $form
 * @property integer|null $formed
 * @property Carbon $formed_at
 * @property Member $former
 * @property integer|null $store
 * @property Carbon $store_at
 * @property Member $stored
 * @property string|null $invoice
 * @property integer|null $invoiced
 * @property Member|null $invoicer
 * @property integer $company_id
 * @property Company $company
 * @property Purchase $purchases
 * @property Quote $quotes
 * @property Term $terms
 * @property Sold $solds
 * @property array $attributes
 * @property string $name_prev
 * @property string $route_prev
 * @property Member $solder
 * @property integer|null $sold
 * @property Carbon $sold_at
 * @property null|string $name_next
 * @property null|string $route_next
 * @property Member $quoter
 */
class Trade extends Model
{

    protected $fillable = [
        'buy', 'ref', 'purchase', 'purchased_at', 'sold', 'sold_at', 'quoted', 'quote_at', 'delivery', 'delivered_at', 'form',
        'formed', 'formed_at', 'store', 'stored_at', 'invoice', 'invoiced', 'invoiced_at', 'company_id', 'created_at',
        'updated_at'
    ];

    /*
     * juncture
     */
    public function setCreatedAtAttribute()
    {
        $this->attributes['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
}

    public function getProgressAttribute()
    {
        $progress = 0;

        if ($this->purchase) {
            $progress += 20;
        }
        if ($this->sold) {
            $progress += 20;
        }
        if ($this->quoted) {
            $progress += 20;
        }
        if (isset($this->terms[0])) {
            $progress += 20;
        }
        if ($this->delivery) {
            $progress += 10;
        }
        if ($this->store) {
            $progress += 10;
        }
        if ($this->formed) {
            $progress += 10;
        }
        if ($this->invoiced) {
            $progress += 10;
        }

        return $progress;
    }

    public function getNamePrevAttribute()
    {
        if($this->buy){
            if ($this->store) {
                return 'store';
            }
            if ($this->delivery) {
                return 'delivery';
            }
        }
        else{
            if ($this->delivery) {
                return 'delivery';
            }
            if ($this->store) {
                return 'store';
            }
        }

        if (isset($this->terms[0])) {
            return 'term';
        }
        return null;
    }

    public function getNameNextAttribute()
    {
        if ($this->quoted) {
            if (!isset($this->terms[0])) {
                return 'Term';
            }
            if($this->buy){
                if (!$this->delivery) {
                    return 'delivery';
                }
                if (!$this->store) {
                    return 'store';
                }
            }
            else{
                if (!$this->store) {
                    return 'store';
                }
                if (!$this->delivery) {
                    return 'delivery';
                }
            }
        }

        return null;
    }

    public function getRoutePrevAttribute()
    {
        if($this->buy){
            if ($this->store) {
                return route('trade.store.store', ['trade' => $this]);
            }
            if ($this->delivery) {
                return route('trade.delivery.destroy', ['trade' => $this]);
            }
        }
        else{
            if ($this->delivery) {
                return route('trade.delivery.destroy', ['trade' => $this]);
            }
            if ($this->store) {
                return route('trade.store.store', ['trade' => $this]);
            }
        }

        if (isset($this->terms[0])) {
            return route('buy.term.destroy', ['trade' => $this]);
        }
        return null;
    }

    public function getRouteNextAttribute()
    {
        if ($this->quoted) {
            if (!isset($this->terms[0])) {
                return route('buy.term.create', ['trade' => $this]);
            }
            if($this->buy){
                if (!$this->delivery) {
                    return route('trade.delivery.store', ['trade' => $this]);
                }
                if (!$this->store) {
                    return route('trade.store.store', ['trade' => $this]);
                }
            }
            else{
                if (!$this->store) {
                    return route('trade.store.store', ['trade' => $this]);
                }
                if (!$this->delivery) {
                    return route('trade.delivery.store', ['trade' => $this]);
                }
            }
        }
        return null;
    }

    public function getQuoteAttribute()
    {
        return $this->quotes()->where('selected', true)->first();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function purchased()
    {
        return $this->belongsTo(Member::class, 'purchase');
    }

    public function delivered()
    {
        return $this->belongsTo(Member::class, 'delivery');
    }

    public function former()
    {
        return $this->belongsTo(Member::class, 'formed');
    }

    public function stored()
    {
        return $this->belongsTo(Member::class, 'store');
    }

    public function invoicer()
    {
        return $this->belongsTo(Member::class, 'invoiced');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function quoter()
    {
        return $this->belongsTo(Member::class, 'quoted');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function solder()
    {
        return $this->belongsTo(Member::class, 'sold');
    }

    public function solds()
    {
        return $this->hasMany(Sold::class);
    }

    /*
     * deployment
     */

    public function listBuy()
    {
        return $this->where([
            ['company_id',auth()->user()->member->company->id],
            ['buy',true]

        ])->where(function ($query) {
            $query->where('purchase',null)
                ->orWhere('quoted',null)
                ->orWhere('delivery',null)
                ->orWhere('formed',null)
                ->orWhere('store',null)
                ->orWhere('invoiced',null);
        })->get();
    }

    public function listSale()
    {
        return auth()->user()->member->company->trades()->where('buy', false)->get();
    }

    public function onStore($date, ?bool $buy = false): Trade
    {
        $trade = auth()->user()->member->company->trades()->where('buy',$buy)->latest()->first();
        if($trade){
            $ref = $trade->ref + 1;
        }
        else{
            $ref = 1;
        }
        return $this->create([
            'buy' => $buy,
            'ref' => $ref,
            'company_id' => auth()->user()->member->company_id,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }

    public function onPurchased()
    {
        $this->update([
            'purchase' => auth()->user()->member->id, 'purchased_at' => Carbon::now(),
        ]);
    }

    public function onDeletePurchased()
    {
        $this->update([
            'purchase' => null, 'purchased_at' => null,
        ]);
    }

    public function onSold()
    {
        $this->update([
            'sold' => auth()->user()->member->id, 'sold_at' => Carbon::now(),
        ]);
    }

    public function onDeleteSold()
    {
        $this->update([
            'sold' => null, 'sold_at' => null,
        ]);
    }

    public function onStoreQuote()
    {

        $this->update([
            'quoted' => auth()->user()->member->id,
            'quote_at' => Carbon::now()
        ]);

    }

    public function onDeleteQuote()
    {

        $this->update([
            'quoted' => null, 'quote_at' => null
        ]);

    }

    public function onDeleteTerm()
    {
        foreach ($this->quote->orders as $order) {
            $order->product->update([
                'amount' => $order->product->amount - $order->ttc
            ]);
        }

        foreach ($this->terms as $term) {
            $term->delete();
        }

    }

    public function onStoreDelivery()
    {
        $this->update([
            'delivery' => auth()->user()->member->id, 'delivered_at' => Carbon::now(),
        ]);
    }

    public function onDeleteDelivery()
    {
        $this->update([
            'delivery' => null, 'delivered_at' => null,
        ]);
    }

    public function onStoreForm($formed = null)
    {

        if ($formed) {

            $formed = $formed->store('forms');

        }

        $this->update([
            'form' => $formed, 'formed' => auth()->user()->member->id, 'formed_at' => Carbon::now(),
        ]);
    }

    public function onDeleteForm()
    {

        if ($this->form) {

            Storage::disk('public')->delete($this->form);

        }

        $this->update([
            'form' => null, 'formed' => null, 'formed_at' => null,
        ]);
    }

    public function onStoreStored()
    {
        $this->update([
            'store' => auth()->user()->member->id, 'stored_at' => Carbon::now(),
        ]);
        if ($this->buy){
            if ($this->purchased) {
                foreach ($this->purchases as $purchase) {

                    $purchase->onCreateOffer();

                }
            }
        }
        else{
            foreach ($this->solds as $sold){
                $product = $sold->purchase->product;
                $purchase = $sold->purchase;
                $product->update([
                    'qt' => $product->qt - $purchase->qt
                ]);
                if($product->qt < $product->qt_min){
                    // notification
                }
            }
        }
    }

    public function onDeleteStored()
    {
        if($this->buy){
            $purchases = $this->purchases;

            foreach ($purchases as $purchase) {

                if(isset($purchase->solds[0])){
                    session()->flash('danger','il ya une ou plusieurs vente associé');
                    return false;
                }

            }
            foreach ($purchases as $purchase) {

                $purchase->onDeleteOffer();

            }
        }
        else{
            foreach ($this->solds as $sold){
                $product = $sold->purchase->product;
                $purchase = $sold->purchase;
                $product->update([
                    'qt' => $product->qt + $purchase->qt
                ]);
            }
        }

            $this->update([
                'store' => null, 'stored_at' => null,
            ]);



    }

    public function onStoreInvoice($invoice = null)
    {

        if ($invoice) {

            $invoice = $invoice->store('invoices');

        }

        $this->update([
            'invoice' => $invoice, 'invoiced' => auth()->user()->member->id, 'invoiced_at' => Carbon::now(),
        ]);

    }

    public function onDeleteInvoice()
    {

        if ($this->invoice) {

            Storage::disk('public')->delete($this->invoice);

        }

        $this->update([
            'invoice' => null, 'invoiced' => null, 'invoiced_at' => null,
        ]);

    }


}
