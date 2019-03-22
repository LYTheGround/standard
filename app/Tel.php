<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Info $info
 * @property Info_box $info_box
 */
class Tel extends Model
{
    protected $fillable = ['tel', 'default', 'info_id', 'info_box_id'];

    public function info()
    {
        return $this->belongsTo(Info::class);
    }


    public function info_box()
    {
        return $this->hasOne(Info_box::class);
    }
}
