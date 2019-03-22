<?php

namespace App\Policies\Company;

use App\Company;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function creator(User $user, Company $company)
    {
        return ($user->admin->id === $company->admin_id || $user->admin->type === 'A');
    }
}
