<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CategoryEvent;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryEventPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CategoryEvent');
    }

    public function view(AuthUser $authUser, CategoryEvent $categoryEvent): bool
    {
        return $authUser->can('View:CategoryEvent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CategoryEvent');
    }

    public function update(AuthUser $authUser, CategoryEvent $categoryEvent): bool
    {
        return $authUser->can('Update:CategoryEvent');
    }

    public function delete(AuthUser $authUser, CategoryEvent $categoryEvent): bool
    {
        return $authUser->can('Delete:CategoryEvent');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CategoryEvent');
    }

}