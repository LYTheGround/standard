<?php

namespace App;

use App\Notifications\Rh\CreatePositionNotification;
use App\Notifications\Rh\UpdatePositionNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Info $info
 * @property Member $member
 * @property Company $company
 */
class Position extends Model
{
    protected $fillable = ['position', 'info_id', 'member_id', 'company_id'];

    public function info()
    {
        return $this->belongsTo(Info::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function onStore(array $data,Info $info)
    {
        $info = $info->onCreate($data['face'],$data);

        $position = $info->position()->create([
            'position' => $data['position'],
            'member_id' => auth()->user()->member->id,
            'company_id' => auth()->user()->member->company->id
        ]);

        session()->flash('status',__('rh/position.stored',['value' => $data['position']]));

        Notification::send(auth()->user()->colleagues(), new CreatePositionNotification($position));
    }

    public function onUpdate(Request $request)
    {
        $data = array_merge($request->all(),['city_id' => $request->city]);

        if($request->face){
            $data = array_merge($data, ['face' => $request->file('face')->store('positions')]);
            if($this->info->face){
                Storage::disk('public')->delete($this->info->face);
            }
        }

        $this->update(['position' => $data['position']]);

        $this->info->update($data);

        $this->info->emails[0]->update(['email' => $data['email']]);

        $this->info->tels[0]->update(['tel' => $data['tel']]);

        session()->flash('status', __('rh/position.updated',['value' => $this->info->full_name]));

        Notification::send(auth()->user()->colleagues(), new UpdatePositionNotification($this));

        return $this;
    }

    public function onDelete()
    {
        $this->info->onDelete();

        $this->delete();

        session()->flash('status', __('rh/position.deleted'));
    }

    public function onSwitch(Member $member)
    {
        $this->update(['member_id' => $member->id]);
    }

}
