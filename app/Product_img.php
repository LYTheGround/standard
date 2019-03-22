<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $img
 * @property integer $product_id
 * @property Product $product
 */
class Product_img extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'img', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function onDelete()
    {

        Storage::disk('public')->delete($this->img);

        $this->delete();

    }
}
