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
 * @property integer $trade_id
 * @property integer $product_id
 * @property Trade $trade
 * @property Product $product
 * @property Order $orders
 * @property Sold $solds
 */
class Purchase extends Model
{
    protected $fillable = ['qt', 'qt_offer', 'offer', 'trade_id', 'product_id'];


    /*
     * juncture
     */
    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function solds()
    {
        return $this->hasMany(Sold::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    /*
     * deployment
     */

    public function onStore(array $data, $trade)
    {

        return $this->create([
            'qt'            => $data['qt'],
            'product_id'    => $data['product'],
            'trade_id'      => $trade->id
        ]);

    }

    public function onCreateOffer()
    {

        $this->product->update([
            'qt'    => $this->product->qt + $this->qt
        ]);

        $this->update([
            'qt_offer'  => $this->qt,
            'offer'     => $this->qt,
        ]);

    }

    public function onDeleteOffer()
    {
        $this->product->update([
            'qt'    => $this->product->qt - $this->qt
        ]);

        $this->update([
            'qt_offer'  => 0,
            'offer'     => 0
        ]);

    }

}
