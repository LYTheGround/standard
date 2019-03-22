<?php

namespace App\Policies\Trade;

use App\Trade;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class TradePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Trade $trade)
    {

        return (($trade->company_id === $user->member->company_id) && ($trade->progress < 100 || auth()->user()->cadre() || Carbon::parse($trade->updated_at)->format('Y-m') === Carbon::now()->format('Y-m')));

    }

    public function deleteBuy(User $user, Trade $trade)
    {

        return !$trade->purchase;

    }

    public function deleteConfirmPurchase(User $user, Trade $trade)
    {

        return !$trade->quote;

    }

    public function deleteQuote(User $user, Trade $trade)
    {

        return !$trade->quote;

    }

    public function confirmQuote(User $user, Trade $trade)
    {

        return $trade->purchase && !$trade->quoted && $trade->quote && !isset($trade->terms[0]);

    }

    public function deleteConfirmQuote(User $user, Trade $trade)
    {

        return $trade->purchase && $trade->quoted && !isset($trade->terms[0]);

    }

    public function confirmSold(User $user, Trade $trade)
    {
        return !$trade->purchase && !$trade->quoted;
    }

    public function deleteConfirmSold(User $user, Trade $trade)
    {
        return $trade->sold && $trade->quoted && !isset($trade->terms[0]);
    }

}
