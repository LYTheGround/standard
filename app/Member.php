<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $user_id
 * @property integer $info_id
 * @property integer $premium_id
 * @property integer $company_id
 * @property User $user
 * @property Info $info
 * @property Company $company
 * @property Premium $premium
 * @property Position $positions
 * @property Product $products
 * @property Deal $deals
 * @property Trade $purchased
 * @property Trade $solder
 * @property Trade $delivered
 * @property Trade $stored
 * @property Trade $trade_forms
 * @property Trade $invoices
 * @property Term $creatorTerms
 * @property Term $payedTerms
 * @property Unload $unloads
 */
class Member extends Model
{
    protected $fillable = [
        'slug', 'name', 'user_id', 'info_id', 'premium_id', 'company_id',
        'deleted_at'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
     * juncture
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function info()
    {
        return $this->belongsTo(Info::class);
    }

    public function premium()
    {
        return $this->belongsTo(Premium::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
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

    public function purchased()
    {
        return $this->hasMany(Trade::class,'purchased');
    }


    public function solder()
    {
        return $this->hasMany(Trade::class,'sold');
    }

    public function delivered()
    {
        return $this->hasMany(Trade::class,'delivered');
    }

    public function stored()
    {
        return $this->hasMany(Trade::class,'stored');
    }

    public function tradeForms()
    {
        return $this->hasMany(Trade::class,'formed');
    }

    public function invoices()
    {
        return $this->hasMany(Trade::class,'invoice_member_id');
    }

    public function creatorTerms()
    {
        return $this->hasMany(Term::class,'creator_id');
    }

    public function payedTerms()
    {
        return $this->hasMany(Term::class,'payed_id');
    }

    public function unloads()
    {
        return $this->hasMany(Unload::class);
    }

    /*
     * deployment
     */

    public function listProducts()
    {
        return $this->products()->with(['imgs'])->limit(5)->get();
    }

    public function listDeals()
    {
        return $this->deals()
            ->with(['infoBox.city', 'infoBox.emails', 'infoBox.tels', 'member.info'])
            ->limit(5)
            ->get();
    }

    public function onCreate(User $user, Info $info, Premium $premium, array $data)
    {
        $user = $user->onCreate($data);

        $face = null;

        if(isset($data['face'])) $face = $info->face($data,null);

        $info = $info->onCreate($face, $data);

        $token = Token::where('token', $data['token'])->first();

        $premium = $premium->onCreate($token);

        $member = $user->member()->create([
            'name' => $data['name'],
            'info_id' => $info->id,
            'premium_id' => $premium->id,
            'company_id' => $token->company_id
        ]);

        $member->update([
            'slug' => str_slug($member->name . ' ' . $member->id)
        ]);

        return $user;
    }

    public function onDelete()
    {
        if($this->canDelete()) {

            $this->remove();

        }
        else {

            $this->archived();

        }
    }

    private function remove()
    {
        $this->user->onDelete();

        $this->info->onDelete();

        $this->premium->delete();

        foreach ($this->positions as $position) {

            $position->onSwhitch(auth()->user()->member);

        }

        foreach ($this->products as $product) {

            $product->onSwitch(auth()->user()->member);

        }

        foreach ($this->deals as $deal) {

            $deal->onSwitch(auth()->user()->member);

        }

        $this->delete();

        session()->flash('status', __('rh/member.deleted'));
    }

    private function archived()
    {
        $this->update([
            'deleted_at' => Carbon::now(),
            'deleted_by' => auth()->user()->member->id
        ]);
    }

    private function canDelete()
    {
        return ($this->haveTrade()) ? false : true;
    }

    private function haveTrade()
    {
        return (
            isset($this->deliveries[0])
        ||  isset($this->stores[0])
        ||  isset($this->deliveryForms[0])
        ||  isset($this->invoices[0])
        );
    }

    public function onForceDelete()
    {
        $this->user->onDelete();

        $this->info->onDelete();

        $this->premium->delete();

        foreach ($this->positions as $position) {
            $position->onDelete();
        }

        foreach ($this->products as $product) {

            $product->onDelete();

        }

        foreach ($this->deals as $deal) {

            $deal->onDelete();

        }

        $this->delete();
    }

    public function colleagues()
    {
        return $this->company->members()->with([
            'info.city', 'info.emails', 'info.tels', 'premium.category', 'premium.status'
        ])->get();
    }

}
