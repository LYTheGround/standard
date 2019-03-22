<?php

namespace App\Policies\Premium;

use App\Token;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TokenPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        $category = $user->member->premium->category->category;

        return  ($category === 'pdg' || $category === 'manager');
    }

    public function delete(User $user,Token $token):bool
    {

        $category = $user->member->premium->category->category;

        return ($token->company_id === $user->member->company_id)
            && ($category === 'pdg' || $category === 'manager');

    }
}
