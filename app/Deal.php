<?php

namespace App;

use App\Http\Requests\Deal\DealRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $slug
 * @property string $description
 * @property integer $info_box_id
 * @property integer $member_id
 * @property integer $company_id
 * @property Carbon $deleted_at
 * @property Info_box $infoBox
 * @property Member $member
 * @property Company $company
 * @property Quote $quotes
 * @property Term $payerTerms
 * @property Deal_product $products
 */
class Deal extends Model
{
    protected $fillable = [
        'slug', 'description', 'info_box_id', 'member_id', 'company_id', 'deleted_at'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    /*
     * juncture
     */

    public function infoBox()
    {
        return $this->belongsTo(Info_box::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function payerTerms()
    {
        return $this->hasMany(Term::class,'payer_id');
    }

    public function products()
    {
        return $this->hasMany(Deal_product::class);
    }

    /*
     * deployment
     */

    public function liste()
    {
        return auth()->user()->member
            ->company->deals()
            ->with(['infoBox.city', 'infoBox.emails', 'infoBox.tels', 'member.info'])
            ->get();
    }

    public function listDashboard()
    {
        return auth()->user()->member
            ->company->deals()
            ->with(['infoBox.city', 'infoBox.emails', 'infoBox.tels', 'member.info'])
            ->limit(5)
            ->get();
    }

    public function onStore(DealRequest $request, Info_box $box)
    {
        $request->request->add([
            'member_id'     => auth()->user()->member->id,
            'company_id'    => auth()->user()->member->company_id,
            'city_id'       => $request->city
        ]);

        $request->request->add([
            'info_box_id' => $box->onStore($request)->id
        ]);

        $deal = $this->create($request->all(['description','info_box_id', 'member_id','company_id']));

        $deal->update(['slug' => str_slug($request->name . ' ' . $deal->id)]);

        return $deal;
    }

    public function onUpdate(DealRequest $request, Deal $deal)
    {
        $data = array_merge([
            'city_id'   => $request->city
        ],$request->all([
            'ice', 'fax', 'speaker',
            'address', 'build', 'floor', 'apt_nbr',
            'zip',
        ]));

        $deal->update($request->all(['name']));

        $deal->infoBox()->update($data);

        $deal->infoBox->emails()->update(['email' => $request->email]);

        $deal->infoBox->tels()->update(['tel' => $request->tel]);

        return $deal;

    }

    public function onDelete()
    {
        $this->delete();
    }

    public function onSwitch(Member $member)
    {
        $this->update(['member_id' => $member->id]);
    }

}
