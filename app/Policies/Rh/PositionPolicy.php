<?php

namespace App\Policies\Rh;

use App\Position;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;

    public function view(User $user,Position $position)
    {
        return $position->company_id === $user->member->company_id;
    }

    public function update(User $user, Position $position)
    {
        if($this->view($user,$position)){
            if($user->member->id == $position->member_id){
                return true;
            }
            else{
                if($user->category() == 'pdg' || $user->category() == 'manager') return true;
            }
        }
        return false;
    }
}
