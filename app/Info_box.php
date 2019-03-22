<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $name
 * @property City $city
 * @property Email $emails
 * @property Tel $tels
 * @property Company $company
 * @property Deal $deals
 */
class Info_box extends Model
{
    protected $fillable = [
        'brand', 'name', 'licence', 'ice', 'turnover', 'taxes',
        'fax', 'speaker', 'address', 'build', 'floor', 'apt_nbr', 'zip', 'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function tels()
    {
        return $this->hasMany(Tel::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function onStore($request)
    {
        $info_box = $this->create($request->all([
            'brand', 'name', 'licence', 'ice',
            'turnover', 'taxes', 'fax', 'speaker',
            'address', 'build', 'floor', 'apt_nbr',
            'zip', 'city_id'
        ]));

        $info_box->emails()->create(['email' => $request->email, "default" => 1]);

        $info_box->tels()->create(['tel' => $request->tel, "default" => 1]);

        return $info_box;
    }
}
