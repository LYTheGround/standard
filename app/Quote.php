<?php

namespace App;

use Carbon\Carbon;
use function foo\func;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $slug
 * @property mixed $ht
 * @property mixed $tva
 * @property mixed $tva_payed
 * @property mixed $ttc
 * @property mixed $is
 * @property mixed $profit
 * @property boolean $selected
 * @property integer $trade_id
 * @property integer $deal_id
 * @property Trade $trade
 * @property Deal $deal
 * @property Order $orders
 * @property Term $terms
 * @property array $calculate
 */
class Quote extends Model
{
    protected $fillable = [
        'ht', 'tva', 'tva_payed', 'ttc', 'is', 'profit', 'selected', 'trade_id', 'deal_id'
    ];

    private $calculate = [
        'ht'        => 0,
        'tva'       => 0,
        'tva_payed' => 0,
        'ttc'       => 0,
        'is'        => 0,
        'profit'    => 0,
    ];

    /*
     * juncture
     */
    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }
    /*
     * deployment
     */

    public function onStore($request, Trade $trade,Order $order)
    {
        $this->deselect($trade);

        $quote =  $this->onCreate($trade,$request->deal);

        if($trade->buy){

            $data = $order->onBuyStore($request,$trade->purchases,$quote);

        }
        else{

            $data = $order->onSaleStore($request, $trade->solds, $quote);

        }

        $quote->calculate($data);

        $quote->save();

        return $quote;
    }

    private function onCreate(Trade $trade, $deal): Quote
    {
        return $this->create([
            'ht'            => 0,
            'tva'           => 0,
            'tva_payed'     => 0,
            'ttc'           => 0,
            'is'            => 0,
            'profit'        => 0,
            'selected'      => true,
            'trade_id'      => $trade->id,
            'deal_id'       => $deal
        ]);
    }

    public function calculate($data)
    {
        foreach ($data as $datum) {
            $this->ht += $datum->ht;
            $this->tva += $datum->tva;
            $this->tva_payed += $datum->tva_payed;
            $this->ttc += $datum->ttc;
            $this->is += $datum->is;
            $this->profit += $datum->profit;
        }
    }

    private function inventory()
    {
        $this->update($this->calculate);
    }

    private function deselect(Trade $trade)
    {
        foreach ($trade->quotes as $quote) {
            $quote->update(['selected' => false]);
        }
    }

    public function onDelete(Trade $trade)
    {
        $selected = null;

        if($this->selected){
            $selected = true;
        }

        foreach ($this->orders as $order) {
            $order->delete();
        }

        $this->delete();

        if($selected){
            $this->selectedChoice($trade);
        }

    }

    private function selectedChoice(Trade $trade)
    {

        if($trade->quotes){
            $ttc = $trade->quotes->min('ttc');

            $min = $trade->quotes()->where('ttc',$ttc)->first();
            //dd($min);
            $min->update(['selected' => true]);
        }

    }

    public function onSelected(Trade $trade)
    {

        $this->deselect($trade);

        $this->update([
            'selected' => true
        ]);

    }


}
