<?php

namespace App;

use App\Notifications\Auth\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Admin $admin
 * @property Member $member
 */
class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = ['login', 'email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function adminA()
    {
        return Admin::where('type',"A")->with(['user'])->first()->user;
    }

    public function onCreate(array $data)
    {
        return $this->create([
            "login"     => $data['name'],
            "email"     => $data['email'],
            "password"  => bcrypt($data['password']),
        ]);
    }

    public function onDelete()
    {
        $this->delete();
    }

    public function colleagues()
    {
        return $this->member->company->members->reject(function ($member) {
            return $member->user->id === $this->id;
        })->map(function ($member) {
            return $member->user;
        });
    }

    public function category()
    {
        return $this->member->premium->category->category;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function deals()
    {
        return auth()->user()->member->company->deals;
    }

    public function cadre()
    {
        return $this->category() === 'pdg' || $this->category() === 'manager' || $this->category() === 'accounting';
    }

}
