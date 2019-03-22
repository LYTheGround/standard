<?php

namespace App;

use App\Http\Requests\Storage\ProductRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property String $slug
 * @property string $ref
 * @property string $name
 * @property string $description
 * @property integer $tva
 * @property integer $qt
 * @property integer $min_qt
 * @property integer $member_id
 * @property integer $company_id
 * @property Company $company
 * @property Member $member
 * @property Product_img $imgs
 * @property Purchase $purchases
 * @property Deal_product $deals
 */
class Product extends Model
{
    protected $fillable = [
        'slug', 'ref', 'name', 'description', 'size', 'tva', 'qt', 'min_qt', 'amount', 'member_id', 'company_id', 'deleted_at'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
     * juncture
     */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function imgs()
    {
        return $this->hasMany(Product_img::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal_product::class);
    }

    /*
     * deployment
     */

    public function liste()
    {
        return auth()->user()->member->company->products()->with(['imgs'])->get();
    }

    public function listDashboard()
    {
        return auth()->user()->member->company
            ->products()->with(['imgs'])
            ->limit(6)->get();
    }

    public function onStore(ProductRequest $request)
    {
        $data = array_merge(
            [
                'ref' => $this->incrementRef(),
                'member_id'     => auth()->user()->member->id,
                'company_id'    => auth()->user()->member->company_id
            ],
            $request->all(['name', 'description', 'size', 'tva', 'min_qt'])
        );
        $product = $this->create($data);

        $product->update([
            'slug' => str_slug($request->name . ' ' . $product->id),
        ]);

        if($request->img[0]){
            foreach ($request->img as $img) {
                $product->imgs()->create([
                    'img'   => $img->store('products')
                ]);
            }
        }

        return $product;
    }

    private function incrementRef()
    {

        $ref = auth()->user()->member->company->products()->orderBy('id', 'desc')->first();

        return (isset($ref->ref)) ? $ref->ref + 1 : 1;
    }

    public function onUpdate(ProductRequest $request)
    {

        if($request->img){
            foreach ($request->img as $img) {
                $this->imgs()->create([
                    'img'   => $img->store('products')
                ]);
            }
        }

        return $this->update($request->all([
            'name', 'description', 'size', 'tva', 'min_qt'
        ]));

    }

    public function onDelete()
    {

        foreach ($this->imgs as $img) {
            $img->onDelete();
        }

        $this->delete();

    }

    public function onSwitch(Member $member)
    {
        $this->update([
            'member_id' => $member->id
        ]);
    }

    public function onAmount(Quote $quote)
    {
        foreach ($quote->orders as $order) {
            $this->update([
                'amount' => $this->amount + $order->ttc
            ]);
        }
    }
}
