<?php

namespace App;

use App\Http\Requests\Company\CompanyRequest;
use App\Http\Requests\Company\SoldRequest;
use App\Http\Requests\Company\StatusRequest;
use App\Notifications\Company\CreateCompanyNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Info_box $info_box
 * @property Premium $premium
 * @property Admin $admin
 * @property Token $tokens
 * @property Member $members
 * @property Position $positions
 * @property Product $products
 * @property Deal $deals
 * @property Trade $trades
 * @property Year $years
 * @property Term $terms
 * @property Unload $unloads
 * @property Sold $solds
 */
class Company extends Model
{

    Use Notifiable;

    protected $fillable = ['slug', 'info_box_id', 'premium_id', 'admin_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    /*
     * juncture
     */
    public function premium()
    {
        return $this->belongsTo(Premium::class);
    }

    public function info_box()
    {
        return $this->belongsTo(Info_box::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function trades_purchase_offer()
    {
        return $this->products()->where('qt','>',0)->with(['purchases'])->get();
    }
    public function years()
    {
        return $this->hasMany(Year::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function unloads()
    {
        return $this->hasMany(Unload::class);
    }


    /*
     * deployment
     */
    public function liste()
    {
        return $this->with(['info_box.tels', 'info_box.emails', 'premium.status'])->get();
    }

    public function onStore(CompanyRequest $request, Premium $premium, Info_box $info_box, User $user)
    {
        $premium = $premium->onCreateCompany();

        $info_box = $info_box->onStore($request);

        $company = $premium->company()->create([
            'slug' => str_slug($request->name . ' ' . $info_box->id),
            'admin_id' => auth()->user()->admin->id,
            'info_box_id' => $info_box->id
        ]);

        $token = $company->tokens()->create([
            'range' => 5,
            'token' => md5(sha1(rand())),
            'category_id' => 2,
        ]);

        session()->flash('status', __('company/company.stored'));

        //Notification::send($user->adminA(), new CreateCompanyNotification($company, $info_box));

       // $info_box->emails[0]->sendTokenSwitchNotification($token);

        return $company;
    }

    public function onUpdate(CompanyRequest $request)
    {

        session()->flash('status', __('company/company.updated'));

        return $this->info_box()->update($request->all());
    }

    public function onDelete()
    {
        if ($this->info_box->brand)

            Storage::disk('public')->delete($this->info_box->brand);

        $this->info_box->delete();

        $this->premium->delete();

        foreach ($this->members as $member) {

            $member->onForceDelete();

        }

        foreach ($this->trades as $trade) {

            $trade->onForceDelete();

        }

        $this->delete();

        session()->flash('status', __('company/company.deleted'));
    }

    public function onUpdateStatus(StatusRequest $request, Premium $premium)
    {
        return $premium->updateStatus($request->status, $this);
    }

    public function onUpdateSold(SoldRequest $request)
    {
        return $this->premium->update(['sold' => $request->sold + $this->premium->sold]);
    }

    public function activate()
    {
        $premium = $this->premium;
        $date = $premium->range;
        $premium->update([
            'range' => 0, 'limit' => gmdate("Y-m-d", strtotime("+$date days")),
            'status_id' => Status::where('status', 'active')->first()->id
        ]);
    }


}
