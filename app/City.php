<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Admin $admins
 * @property Info $infos
 * @property Info_box $info_box
 */
class City extends Model
{
    protected $fillable = ['city'];

    public $timestamps = false;

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function infos()
    {
        return $this->hasMany(Info::class);
    }

    public function info_box()
    {
        return $this->hasMany(Info_box::class);
    }
}
