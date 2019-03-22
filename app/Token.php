<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Category $category
 * @property Company $company
 */
class Token extends Model
{
    protected $fillable = ['range', 'token', 'category_id', 'company_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public  function liste()
    {
        return auth()->user()->member->company->tokens;
    }
    public function onCreate(Company $company, int $range, int $category_id)
    {
        $premium = $company->premium;

        $premium->update(['sold' => $premium->sold - $range]);

        return $company->tokens()->create([
            'range' => $range,
            'token' => md5(sha1(rand())),
            'category_id' => $category_id
        ]);
    }

    public function onDelete()
    {
        $premium = auth()->user()->member->company->premium;

        $premium->update(['sold'  => $premium->sold + $this->range]);

        $this->delete();
    }

}
