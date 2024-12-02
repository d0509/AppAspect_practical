<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;
    private $verifiedUserRole;

    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function viewAny(User $user)
    {
        return $user->hasPermission('view-category');
    }

    public function view(User $user, Category $category)
    {
        return $user->hasPermission('view-category');
    }

    public function create(User $user)
    {
        return $user->hasPermission('add-category');
    }

    public function update(User $user, Category $category)
    {
        return $user->hasPermission('edit-category');
    }

    public function delete(User $user, Category $category)
    {
        return $user->hasPermission('delete-category');
    }
}
