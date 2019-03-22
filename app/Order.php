<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property array $attributes
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed $pu
 * @property mixed $ht
 * @property mixed $tva
 * @property mixed $tva_payed
 * @property mixed $ttc
 * @property mixed $is
 * @property mixed $profit
 * @property integer $quote_id
 * @property integer $purchase_id
 * @property integer $sold_id
 * @property Quote $quote
 * @property Purchase $purchase
 * @property Sold $sold
 * @property array $data
 */

class Order extends Model
{

    protected $fillable = [
        'pu', 'ht', 'tva', 'tva_payed', 'ttc', 'is', 'profit',
        'quote_id', 'purchase_id', 'sold_id'
    ];

    private $data = [];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function sold()
    {
        return $this->belongsTo(Sold::class);
    }

    public function onBuyStore(Request $request, $purchases, $quote)
    {
        foreach ($purchases as $purchase) {
            $pu = $request->pu[$purchase->id];
            $ht = $pu * $purchase->qt;
            $tva = ($ht * $purchase->product->tva) / 100;
            $ttc = $ht + $tva;

            $data = [
                'pu'            => floatval($pu),
                'ht'            => floatval($ht),
                'tva'           => floatval($tva),
                'tva_payed'     => floatval($tva),
                'ttc'           => floatval($ttc),
                'is'            => 0,
                'profit'        => 0,
                'purchase_id'   => $purchase->id,
                'quote_id'      => $quote->id
            ];

            $this->data[] = $this->create($data);

        }

        return $this->data;

    }

    public function onSaleStore($request, $solds, $quote)
    {

        $data = $request->all();

        foreach ($solds as $sold) {

            $pu = $data["pu[$sold->id]"];
            $ht = $pu * $sold->qt;
            $tva = ($ht * $sold->purchase->product->tva) / 100;
            $ttc = $ht + $tva;
            $purchaseOrder = $this->orderBuy($sold->purchase)[0];
            $tva_payed = (($tva / $sold->qt) - ($purchaseOrder->tva_payed / $sold->purchase->qt)) * $sold->qt;
            $profit = ((($ttc / $sold->qt) - ($purchaseOrder->ttc / $sold->purchase->qt)) * $sold->qt) - $tva_payed;
            $is = (floatval(auth()->user()->member->company->info_box->taxes) / 100) * $profit;

            $profit = $profit - $is;

            $data = [
                'pu'            => floatval($pu),
                'ht'            => floatval($ht),
                'tva'           => floatval($tva),
                'tva_payed'     => floatval($tva_payed),
                'ttc'           => floatval($ttc),
                'is'            => floatval($is),
                'profit'        => floatval($profit),
                'quote_id'      => $quote->id,
                'sold_id'       => $sold->id
            ];

            $this->data[] = $this->create($data);

        }

        return $this->data;

    }

    public function orderBuy(Purchase $purchase)
    {

        return  $purchase->orders->reject(function ($query){

            if(!$query->quote->selected){

                return $query;

            }

            return 0;
        });

    }

    public function onStoreDealProduct()
    {
        //
    }

    public function onDeleteDealProduct()
    {

    }
}
