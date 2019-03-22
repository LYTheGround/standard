<?php

namespace App;

use App\Http\Requests\Admin\AdminRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property City $city
 * @property Company $companies
 */
class Admin extends Model
{
    protected $fillable = ['type', 'tel', 'user_id', 'city_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public static function liste()
    {
        return self::with(['user','city'])->get();
    }

    public  function onShow()
    {
        return $this->companies()->with(['info_box.tels', 'info_box.emails', 'premium.status'])->get();
    }

    public function onStore(AdminRequest $request)
    {
        session()->flash('status', __('admin/admin.stored'));

        return User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->admin()->create([
            'type' => 'B',
            'tel' => $request->tel,
            'city_id' => $request->city
        ]);
    }

    public function onUpdate(AdminRequest $request)
    {
        auth()->user()->email = $request->email;
        auth()->user()->login = $request->login;

        if($request->password){
            auth()->user()->password = Hash::make($request->password);
        }

        auth()->user()->save();

        auth()->user()->admin->update(['city_id' => $request->city, 'tel' => $request->tel]);

        session()->flash('status', __('admin/admin.updated'));

        return auth()->user()->admin;
    }

    public function ownerSwitch(int $owner_id)
    {
        foreach ($this->companies as $company) {
            $company->update(['admin_id' => $owner_id]);
        }
    }

    public function onDelete()
    {
        if(isset($this->companies[0])){
            $this->ownerSwitch(auth()->user()->admin->id);
        }

        $this->user->delete();

        $this->delete();

        session()->flash('status',__('admin/admin.deleted'));

        return redirect()->route('admin.index');
    }
}
