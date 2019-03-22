<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $justify
 * @property mixed $prince
 * @property mixed $date
 * @property boolean $tva
 * @property integer $month_id
 * @property integer $company_id
 * @property Month $month
 * @property Company $company
 * @property Member $member
 */
class Unload extends Model
{
    protected $fillable = ['justify', 'prince', 'date','description', 'tva', 'member_id', 'month_id', 'company_id'];

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function listUnload()
    {
        $month = Carbon::now()->format('Y-m');
        $next = Carbon::now()->addMonth()->format('Y-m');
        $star = Carbon::parse($month . '-01')->format('Y-m-d');
        $end = Carbon::parse($next . '-01')->format('Y-m-d');
        return $this->where([
            ['company_id',auth()->user()->member->company_id],
            ['date','>=',$star],
            ['date','<=',$end]
        ])->orderBy('updated_at','desc')->get();
    }

    public function onStore($justify, $data,Month $month)
    {
        $month = $month->select($data['date']);
        if($data['on'] === 'tva'){
            $tva = true;
            $month->addUnloadedTva($data['prince']);
        }
        else{
            $tva = false;
            $month->addUnloadedIs($data['prince']);
        }
        return auth()->user()->member->unloads()->create([
            'justify'       => $justify,
            'prince'        => $data['prince'],
            'date'          => $data['date'],
            'description'   => $data['description'],
            'tva'           => $tva,
            'month_id'      => $month->id,
            'company_id'    => auth()->user()->member->company_id
        ]);
    }

    public function onUpdate($justify, $data)
    {
        $month = $this->month;
        if($this->tva){
            $month->subUnloadedTva($this->prince);
        }
        else{
            $month->subUnloadedIs($this->prince);
        }
        if($data['on'] === 'tva'){
            $tva = true;
            $month->addUnloadedTva($data['prince']);
        }
        else{
            $tva = false;
            $month->addUnloadedIs($data['prince']);
        }
        $this->update([
            'justify'       => $justify,
            'prince'        => $data['prince'],
            'date'          => $data['date'],
            'description'   => $data['description'],
            'tva'           => $tva,
        ]);
    }

    public function onDelete()
    {
        if($this->tva){
            $this->month->subUnloadedTva($this->prince);
        }
        else{
            $this->month->subUnloadedIs($this->prince);
        }
        $this->delete();
    }

}
