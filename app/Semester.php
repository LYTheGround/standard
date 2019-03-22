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
 * @property integer $year_id
 * @property Year $year
 * @property Month $months
 */
class Semester extends Model
{
    protected $fillable = [
        'profit', 'tva', 'unloaded_tva', 'is', 'unloaded_is',
        'month', 'year_id'
    ];

    /*
     * juncture
     */
    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function months()
    {
        return $this->hasMany(Month::class);
    }

    /*
     * deployment
     */
    public function select($date = null)
    {
        if(!is_null($date)){
            $month = Carbon::parse($date)->format('m');
        }
        else{
            $month = Carbon::now()->format('m');
            $date = Carbon::now()->format('Y-m-d');
        }
        $semester =  $this->choice($this->this($month));
        return ($semester) ? $semester :  $this->onStore($date);
    }

    private function choice($semester)
    {
        switch ($semester) {

            case 1;
                return $this->where([
                    ['month', '>', Carbon::parse(date('Y') . '-1')->format('Y-m')],
                    ['month', '<', Carbon::parse(date('Y') . '-3')->format('Y-m')],
                ])->first();
                break;

            case 2;
                return $this->where([
                    ['month', '>', Carbon::parse(date('Y') . '-4')->format('Y-m')],
                    ['month', '<', Carbon::parse(date('Y') . '-6')->format('Y-m')],
                ])->first();
                break;

            case 3;
                return $this->where([
                    ['month', '>', Carbon::parse(date('Y') . '-6')->format('Y-m')],
                    ['month', '<', Carbon::parse(date('Y') . '-9')->format('Y-m')],
                ])->first();
                break;

            case 4;
                return $this->where([
                    ['month', '>', Carbon::parse(date('Y') . '-9')->format('Y-m')],
                    ['month', '<', Carbon::parse(date('Y') . '-12')->format('Y-m')],
                ])->first();
                break;
        }
    }

    private function this($month)
    {
        switch ($month) {
            case 1:
                return 1;
                break;
            case 2:
                return 1;
                break;
            case 3:
                return 1;
                break;
            case 4:
                return 2;
                break;
            case 5:
                return 2;
                break;
            case 6:
                return 2;
                break;
            case 7:
                return 3;
                break;
            case 8:
                return 3;
                break;
            case 9:
                return 3;
                break;
            case 10:
                return 4;
                break;
            case 11:
                return 4;
                break;
            case 12:
                return 4;
                break;
        }
    }

    private function onStore($date)
    {
        $year = new Year();
        if(is_null($date)){
            $month = Carbon::parse(date('Y-m' . '-01'))->format('Y-m-d');
        }
        else{
            $month = Carbon::parse(Carbon::parse($date)->format('Y-m') . '-01')->format('Y-m-d');
        }
        return $this->create([
            'month'     => $month,
            'year_id'   => $year->select($date)->id
        ]);

    }

    public function addPayement($quote)
    {

        $this->update([
            'profit' => $this->profit + $quote->profit,
            'tva' => $this->tva + $quote->tva_payed,
            'is' => $this->is + $quote->is,
        ]);

        $this->year->addPayement($quote);
    }

    public function subPayement($quote)
    {

        $this->update([
            'profit' => $this->profit - $quote->profit,
            'tva' => $this->tva - $quote->tva_payed,
            'is' => $this->is - $quote->is,
        ]);

        $this->year->subPayement($quote);
    }

    public function addUnloadedTva($tva)
    {
        $this->update([
            'unloaded_tva' => $this->unloaded_tva - $tva
        ]);

        $this->year->addUnloadedTva($tva);
    }

    public function subUnloadedTva($tva)
    {
        $this->update([
            'unloaded_tva' => $this->unloaded_tva + $tva
        ]);

        $this->year->subUnloadedTva($tva);
    }

    public function addUnloadedIs($is)
    {
        $this->update([
            'unloaded_is' => $this->unloaded_is - $is
        ]);

        $this->year->addUnloadedIs($is);
    }

    public function subUnloadedIs($is)
    {
        $this->update([
            'unloaded_is' => $this->unloaded_is + $is
        ]);

        $this->year->subUnloadedIs($is);
    }

}
