<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\RegisUlang;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegisUlangPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:RegisUlang');
    }

    public function view(AuthUser $authUser, RegisUlang $regisUlang): bool
    {
        return $authUser->can('View:RegisUlang');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:RegisUlang');
    }

    public function update(AuthUser $authUser, RegisUlang $regisUlang): bool
    {
        return $authUser->can('Update:RegisUlang');
    }

    public function delete(AuthUser $authUser, RegisUlang $regisUlang): bool
    {
        return $authUser->can('Delete:RegisUlang');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:RegisUlang');
    }

}