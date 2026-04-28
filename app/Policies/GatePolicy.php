<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class GatePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Gate');
    }

    public function view(AuthUser $authUser, Gate $gate): bool
    {
        return $authUser->can('View:Gate');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Gate');
    }

    public function update(AuthUser $authUser, Gate $gate): bool
    {
        return $authUser->can('Update:Gate');
    }

    public function delete(AuthUser $authUser, Gate $gate): bool
    {
        return $authUser->can('Delete:Gate');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Gate');
    }

}