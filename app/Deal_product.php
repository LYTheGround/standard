<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed $min_prince
 * @property mixed $turnover
 * @property mixed $tva
 * @property mixed $is
 * @property mixed $profit
 * @property integer $product_id
 * @property integer $deal_id
 * @property Product $product
 * @property Deal $deal
 */
class Deal_product extends Model
{
    protected $fillable = [
        'min_prince', 'turnover', 'tva', 'is', 'profit', 'product_id', 'deal_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
