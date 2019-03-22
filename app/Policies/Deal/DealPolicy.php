<?php

namespace App\Policies\Deal;

use App\Deal;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Deal $deal)
    {

        return $user->member->company_id === $deal->company_id;

    }

    public function update(User $user, Deal $deal)
    {

        if ($user->category() === 'pdg' || $user->category() === 'manager') return true;

        return $this->view($user, $deal);

    }
}
