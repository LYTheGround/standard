<?php

namespace App;

use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Category $category
 * @property Status $status
 * @property Company $company
 * @property Member $member
 */
class Premium extends Model
{
    protected $fillable = ['sold', 'range', 'limit', 'update_status', 'category_id', 'status_id'];

    protected $table = "premiums";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function onCreateCompany()
    {
        return $this->create([
            'sold'              => 10,
            'range'             => 5,
            'limit'             => null,
            'category_id'       => 1,
            'update_status'     => Carbon::now(),
            'status_id'         => 1
        ]);
    }

    public function updateStatus($status,Company $company)
    {
        $members = $company->members;
        foreach ($members as $member){
            $this->updateStatusMember($status,$company,$member->premium);
        }
        $this->updateStatusCompany($status,$company->premium);
    }

    public function updateStatusMember($status, Company $company, Premium $premium)
    {
        if($status != $premium->status_id){
            if($premium->status_id == 1){
                if($status == 2){
                    $premium->update([
                        'range' => 0,
                        'limit' => $this->addDate($premium->range,date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
                elseif ($status == 3){
                    $company->premium->update([
                        'sold' => $company->premium->sold + $premium->range
                    ]);
                    $premium->update([
                        'range' => 0,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 2){
                if($status == 1){
                    $end = strtotime($premium->limit);
                    $start = strtotime(gmdate('Y-m-d'));
                    $diff = $end - $start;
                    if($diff < 0){
                        $diff = 0;
                        $days = $diff / (60 * 60 * 24);
                    }else{
                        $days = $diff / (60 * 60 * 24);
                    }
                    $premium->update([
                        'range' => $days,
                        'limit' => null,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                    ]);
                }
                elseif($status == 3){
                    $end = strtotime($premium->limit);
                    $start = strtotime(gmdate('Y-m-d'));
                    $diff = $end - $start;
                    if($diff < 0){
                        $diff = 0;
                        $days = $diff / (60 * 60 * 24);
                    }else{
                        $days = $diff / (60 * 60 * 24);
                    }
                    $company->premium->update([
                        'sold'  => $company->premium->sold + $days
                    ]);
                    $premium->update([
                        'limit' => null,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 3){
                $company->premium->update([
                    'sold'  => $company->premium->sold - 1
                ]);
                if($status == 1){
                    $premium->update([
                        'range' => 1,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                    ]);
                }
                elseif ($status == 2){
                    $premium->update([
                        'limit' => $this->addDate(1,date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
            }
        }
    }

    public function updateStatusCompany($status, Premium $premium)
    {
        if($status != $premium->status_id){
            if($premium->status_id == 1){
                if($status == 2){
                    $premium->update([
                        'range' => 0,
                        'limit' => $this->addDate($premium->range,date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
                elseif ($status == 3){
                    $premium->update([
                        'range' => 0,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 2){
                if($status == 1){
                    $end = strtotime($premium->limit);
                    $start = strtotime(gmdate('Y-m-d'));
                    $diff = $end - $start;
                    if($diff < 0){
                        $diff = 0;
                        $days = $diff / (60 * 60 * 24);
                    }else{
                        $days = $diff / (60 * 60 * 24);
                    }
                    $premium->update([
                        'range' => $days,
                        'limit' => null,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d',strtotime("+7 days"))
                    ]);
                }
                elseif($status == 3){
                    $premium->update([
                        'limit' => null,
                        'status_id' => 3,
                        'update_status' => gmdate('Y-m-d',strtotime("+20 days"))
                    ]);
                }
            }
            elseif($premium->status_id == 3){
                if($status == 1){
                    $premium->update([
                        'range' => 1,
                        'status_id' => 1,
                        'update_status' => gmdate('Y-m-d', strtotime("+7 days"))
                    ]);
                }
                elseif ($status == 2){
                    $premium->update([
                        'limit' => $this->addDate(1, date('Y-m-d')),
                        'status_id' => 2
                    ]);
                }
            }
        }
    }

    private function addDate($range, $date)
    {
        $date = new DateTime($date);
        $date->add(new DateInterval('P'. $range .'D')); // P1D means a period of 1 day
        return  $date->format('Y-m-d');
    }

    public function onCreate(Token $token)
    {

        if ($token->category_id === 2){ $token->company->activate(); }
        else{
            $company_premium = $token->company->premium;
            $company_premium->update(['sold' => $company_premium->sold]);
        }

        $premium = $this->create([
            'sold'              => 0,
            'range'             => 0,
            'limit'             => date('Y-m-d',strtotime("+$token->range days")),
            'category_id'       => $token->category_id,
            'update_status'     => Carbon::now(),
            'status_id'         => 2
        ]);

        $token->delete();

        return $premium;
    }

    public function onDelete()
    {
        $this->delete();
    }

    public static function diffDaysLimit($limit)
    {
        $end = strtotime($limit);
        $start = strtotime(gmdate('Y-m-d'));
        $diff = $end - $start;
        return $diff / (60 * 60 * 24);
    }

}
