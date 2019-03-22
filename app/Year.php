<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed $profit
 * @property mixed $tva
 * @property mixed $unloaded_tva
 * @property mixed $is
 * @property mixed $unloaded_is
 * @property Carbon $year
 * @property integer $company_id
 * @property Company $company
 * @property Semester $semesters
 */
class Year extends Model
{
    protected $fillable = [
        'profit', 'tva', 'unloaded_tva', 'is', 'unloaded_is',
        'year', 'company_id'
    ];


    /*
     * juncture
     */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    /*
     * deployment
     */

    public function select($date = null): Year
    {
        if(is_null($date)){
            $date = Carbon::now()->format('Y');
        }
        $year = $this->where('year', $date)->first();

        return ($year) ? $year : $this->onStore($date);

    }

    public function onStore($date): Year
    {

        return $this->create([
            'year'          => Carbon::parse($date)->format('Y'),
            'company_id'    => auth()->user()->member->company_id
        ]);

    }

    public function addPayement($quote)
    {
        $this->update([
            'profit' => $this->profit + $quote->profit,
            'tva' => $this->tva + $quote->tva_payed,
            'is' => $this->is + $quote->is,
        ]);
    }

    public function subPayement($quote)
    {
        $this->update([
            'profit'    => $this->profit - $quote->profit,
            'tva'       => $this->tva - $quote->tva_payed,
            'is'        => $this->is - $quote->is,
        ]);
    }

    public function addUnloadedTva($tva)
    {
        $this->update([
            'unloaded_tva' => $this->unloaded_tva - $tva
        ]);
    }

    public function subUnloadedTva($tva)
    {
        $this->update([
            'unloaded_tva' => $this->unloaded_tva + $tva
        ]);
    }

    public function addUnloadedIs($is)
    {
        $this->update([
            'unloaded_is' => $this->unloaded_is - $is
        ]);
    }

    public function subUnloadedIs($is)
    {
        $this->update([
            'unloaded_is' => $this->unloaded_is + $is
        ]);
    }
}
