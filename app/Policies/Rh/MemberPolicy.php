<?php

namespace App\Policies\Rh;

use App\Member;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    public function range(User $user,Member $member):bool
    {
        return ($user->member->premium->category->category === 'pdg'
                || $user->member->premium->category->category === 'manager')
            && ($member->premium->status->status === 'active');
    }

    public function delete(User $user, Member $member)
    {
        return ($user->member->premium->category->category === 'pdg'
                || $user->member->premium->category->category === 'manager')
            && ($member->premium->status->status === 'archived'
                && $member->premium->category->category != 'pdg');
    }
}
