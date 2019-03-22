<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed $payment
 * @property Carbon $date
 * @property integer|null $payed_id member ho mark this payment
 * @property integer|null $payed_by_id
 * @property integer|null $creator_id
 * @property integer|null $company_id
 * @property integer|null $quote_id
 * @property integer|null $trade_id
 * @property Member|null $payed
 * @property Deal $payer
 * @property Member $creator
 * @property Company $company
 * @property Quote $quote
 * @property Trade $trade
 * @property Month $month
 */
class Term extends Model
{
    protected $fillable = [
        'payment', 'date', 'payed_at', 'payed_id', 'payed_by_id', 'creator_id', 'company_id', 'quote_id', 'trade_id',
        'month_id'
    ];


    /*
     * juncture
     */

    public function payed()
    {
        return $this->belongsTo(Member::class, 'payed_id');
    }

    public function payer()
    {
        return $this->belongsTo(Deal::class, 'payed_by_id');
    }

    public function creator()
    {
        return $this->belongsTo(Member::class, 'creator_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }


    /*
     * deployment
     */
    public function liste()
    {
        return Term::where('payed_at', null)->get();
    }

    public function onStorePayed()
    {
        $this->update([
            'payed_id' => auth()->user()->member->id, 'payed_at' => Carbon::now()
        ]);
    }

    public function onDeletePayed()
    {
        $this->update([
            'payed_id' => null, 'payed_at' => null
        ]);
    }

    public function onDelete()
    {
        if ($this->trade->buy) {
            foreach ($this->quote->orders as $order) {
                $product = $order->purchase->product;
                $this->delete_deal_product($order, $product, $this->quote, $order->purchase->qt);
                $product->update([
                    'amount' => $product->amount - $order->ttc
                ]);
            }
        } else {
            foreach ($this->trade->solds as $sold) {
                $this->delete_deal_product($sold->order, $sold->purchase->product, $this->quote, $sold->qt);
                $order = $sold->purchase->orders->map(function ($query) {
                    if ($query->quote()->where('selected', true)->first()) {
                        return $query;
                    }
                })[0];
                $product = $sold->purchase->product;

                $product->update([
                    'amount' => $product->amount + $order->ttc
                ]);
            }
        }


        $month = $this->month->select();

        $month->subPayement($this->quote);

        $this->delete();
    }

    private function delete_deal_product(Order $order, Product $product, Quote $quote, int $qt)
    {
        $ttc = $order->ttc;
        $tva = $order->tva_payed;
        $is = $order->is;
        $profit = $order->profit;
        $product_deal = Deal_product::where([
            ['product_id', $product->id], ['deal_id', $quote->deal_id]
        ])->first();
        if ($product_deal) {
            $product_deal->update([
                'turnover' => $product_deal->turnover - $ttc, 'tva' => $product_deal->tva - $tva,
                'is' => $product_deal->is - $is, 'profit' => $product_deal->profit - $profit,
                'product_id' => $product->id, 'deal_id' => $quote->deal_id
            ]);
        }
    }

    public function onStore($date, $payment, Quote $quote, Month $month)
    {

        foreach ($quote->orders as $order) {

            $product = $order->purchase->product;

            $product->update([
                'amount' => $product->amount + $order->ttc
            ]);

        }

        $month = $month->select();

        $this->create([
            'payment' => $payment, 'date' => $date, 'payed_by_id' => $quote->deal_id,
            'creator_id' => auth()->user()->member->id, 'company_id' => auth()->user()->member->company_id,
            'quote_id' => $quote->id, 'trade_id' => $quote->trade->id, 'month_id' => $month->id
        ]);

        $month->addPayement($quote);
    }
}