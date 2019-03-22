<?php

namespace App\Policies\Storage;

use App\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Product $product)
    {

        return $user->member->company_id === $product->company_id;

    }

    public function update(User $user, Product $product)
    {

        if($user->category() === 'pdg' || $user->category() === 'manager') return true;

        return $this->view($user,$product);

    }
}
