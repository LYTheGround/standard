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
 * @property Carbon $month
 * @property integer $semester_id
 * @property Semester $semester
 * @property Unload $unloads
 * @property Term $terms
 */
class Month extends Model
{

    protected $fillable = [
        'profit', 'tva', 'unloaded_tva', 'is', 'unloaded_is', 'month', 'semester_id'
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function unloads()
    {
        return $this->hasMany(Unload::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    /*
     * deployment
     */
    public function select($date = null): Month
    {
        if(!is_null($date)){
            $month = $this->where('month',Carbon::parse(Carbon::parse($date)->format('Y-m') . '-01')->format('Y-m-d'))->first();
        }
        else{
            $month = $this->where('month',Carbon::parse(date('Y-m' . '-01'))->format('Y-m-d'))->first();
        }
        if($month){
            return $month;
        }
        return $this->onStore($date);
    }

    private function onStore($date = null)
    {

        $semester = new Semester();
        if(is_null($date)){
            $month = Carbon::parse(date('Y-m' . '-01'))->format('Y-m-d');
        }
        else{
            $month = Carbon::parse(Carbon::parse($date)->format('Y-m') . '-01')->format('Y-m-d');
        }
        return $this->create([
            'month' => $month,
            'semester_id' => $semester->select($date)->id
        ]);

    }

    public function addPayement($quote)
    {

        $this->update([
            'profit' => $this->profit + $quote->profit,
            'tva' => $this->tva + $quote->tva_payed,
            'is' => $this->is + $quote->is,
        ]);

        $this->semester->addPayement($quote);

    }

    public function subPayement($quote)
    {

        $this->update([
            'profit' => $this->profit - $quote->profit,
            'tva' => $this->tva - $quote->tva_payed,
            'is' => $this->is - $quote->is,
        ]);

        $this->semester->subPayement($quote);

    }

    public function addUnloadedTva($tva)
    {
        $this->update([
            'unloaded_tva' => $this->unloaded_tva - $tva
        ]);

        $this->semester->addUnloadedTva($tva);
    }

    public function subUnloadedTva($tva)
    {
        $this->update([
            'unloaded_tva' => $this->unloaded_tva + $tva
        ]);

        $this->semester->subUnloadedTva($tva);
    }

    public function addUnloadedIs($is)
    {
        $this->update([
            'unloaded_is' => $this->unloaded_is - $is
        ]);

        $this->semester->addUnloadedIs($is);
    }

    public function subUnloadedIs($is)
    {
        dd($this->is);
        $this->update([
            'unloaded_is' => $this->unloaded_is + $is
        ]);

        $this->semester->subUnloadedIs($is);
    }


}
