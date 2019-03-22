<?php

namespace App;

use App\Notifications\Token\TokenSwitchNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Info $info
 * @property Info_box $info_boxes
 */
class Email extends Model
{
    use Notifiable;
    
    protected $fillable = ['email', 'default', 'info_id', 'info_box_id'];

    public function info()
    {
        return $this->belongsTo(Info::class);
    }

    public function info_boxes()
    {
        return $this->hasMany(Info_box::class);
    }

    public function sendTokenSwitchNotification($token)
    {
        $this->notify(new TokenSwitchNotification($token));
    }
}
