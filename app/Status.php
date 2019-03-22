<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Premium $premiums
 */
class Status extends Model
{
    protected $fillable = ['status'];

    public $timestamps = false;

    public function premiums()
    {
        return $this->belongsTo(Premium::class);
    }
}
