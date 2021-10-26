<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    function create(User $user) 
    {
        // Same as update policy, we consider create is a special case of update.
        return $this->update($user);
    }

    function update(User $user) 
    {
        return$user->isAdministrator('is_admin');
    }
    function delete(User $user, Category $category) 
    {
        // to makesurethereis product_count.
        $category->loadCount('products');
        return $this->update($user) && ($category->products_count === 0);
    }
}
