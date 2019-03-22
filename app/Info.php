<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $full_name
 * @property City $city
 * @property Email $emails
 * @property Tel $tels
 * @property Member $member
 * @property Position $position
 */
class Info extends Model
{
    protected $fillable = ['face', 'last_name', 'first_name', 'sex', 'birth', 'address', 'cin', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getFullNameAttribute()
    {
        return strtoupper($this->last_name) . ' ' . ucfirst($this->first_name);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function tels()
    {
        return $this->hasMany(Tel::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function position()
    {
        return $this->hasOne(Position::class);
    }

    public function onCreate(?string $face,array $data)
    {
        $info = $this->create([
            'face' => $face,
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'sex' => $data['sex'],
            'birth' => $data['birth'],
            'address' => $data['address'],
            'cin' => $data['cin'],
            'city_id' => $data['city']
        ]);

        $info->emails()->create(['email' => $data['email'], 'default' => 1]);

        $info->tels()->create(['tel' => $data['tel'], 'default' => 1]);

        return $info;
    }

    public function face(array $data,?Info $info)
    {
        if(!is_null($data['face'])){
            if(!is_null($info->face)){
                Storage::disk('public')->delete($info->face);
            }
            return $data['face']->store('users');
        }
        if(!is_null($info->face)){
            return $info->face;
        }
        return null;
    }

    public function onDelete()
    {
        foreach ($this->emails as $email) {
            $email->delete();
        }

        foreach ($this->tels as $tel) {
            $tel->delete();
        }

        if ($this->face) {
            Storage::disk('public')->delete($this->face);
        }

        $this->delete();
    }
}
