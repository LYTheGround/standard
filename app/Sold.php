<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $qt
 * @property integer $offer
 * @property integer $purchased_id
 * @property integer $company_id
 * @property Purchase $purchase
 * @property Trade $trade
 * @property Order $order
 */
class Sold extends Model
{
    protected $fillable = [
        'qt', 'purchase_id', 'trade_id'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function onStore($request,Trade $trade,Purchase $purchase)
    {
        $qt = $purchase->offer - $request->qt;

        $purchase->update([
            'offer' => $qt
        ]);

        return $this->create([
            'qt'            => $request->qt,
            'purchase_id'   => $purchase->id,
            'trade_id'      => $trade->id
        ]);

    }

    public function onDelete(Trade $trade)
    {
        if($trade->sold){
            $this->purchase->update([
                'qt'        => $this->qt + $this->purchase->qt,
                'offer'     => $this->qt + $this->purchase->offer
            ]);
        }

        else{

            $this->purchase->update([
                'offer'     => $this->qt + $this->purchase->offer
            ]);

        }

    }
}
