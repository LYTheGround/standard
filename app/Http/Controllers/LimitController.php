<?php

namespace App\Http\Controllers;

use App\Notifications\AccountLimitNotification;
use App\Premium;
use Illuminate\Support\Facades\Notification;

class LimitController extends Controller
{
    public function UserPlan($user)
    {

        if($user->member->premium->status->status == 'active'){
            if ($user->member->premium->limit < gmdate('Y-m-d')) {
                $this->archived($user->member->premium);
                return false;
            }
            else {

                if ($user->member->premium->limit <= gmdate('Y-m-d', strtotime("+1 days"))) {
                    $this->notifications($user, $user->member->premium->limit, 1);
                }

                elseif ($user->member->premium->limit <= gmdate('Y-m-d', strtotime("+5 days"))) {
                    $this->notifications($user, $user->member->premium->limit, 5);
                }

                elseif ($user->member->premium->limit <= gmdate('Y-m-d', strtotime("+10 days"))) {

                    $this->notifications($user, $user->member->premium->limit, 10);
                }

                return true;
            }
        }
        else{
            session()->flash('danger',trans("auth/login.inactive_account"));
            return false;
        }
    }

    public function archived($premium)
    {
        $companyP = $premium->member->company->premium->limit;
        $p = new Premium();
        if ($premium->category->category == 'pdg' || $companyP < gmdate('Y-m-d')) {
            session()->flash('danger', trans("auth/login.inactive_account"));
            $p->updateStatus(3, $premium->member->company);
        }
        else {
            session()->flash('danger', trans("auth/login.inactive_company"));
            $p->updateStatusMember(3, $premium->member->company, $premium);
        }
    }

    public function notifications($user, $limit, $days)
    {
        foreach ($user->notifications as $notification) {
            if ($notification->data['notification_id'] == $limit . '-' . $days) {
                return true;
            }
        }
        $end = strtotime($limit);
        $start = strtotime(gmdate('Y-m-d'));
        $diff = $end - $start;
        $nbrDay = $diff / (60 * 60 * 24);
        Notification::send($user,new AccountLimitNotification($limit,$days,$nbrDay));
        return true;
    }
}
