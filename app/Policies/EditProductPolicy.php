<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EditProductPolicy
{
    use HandlesAuthorization;

    public function owner(User $user, Product $product){
        return true;
    }
}
