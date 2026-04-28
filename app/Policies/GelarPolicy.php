<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Gelar;
use Illuminate\Auth\Access\HandlesAuthorization;

class GelarPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Gelar');
    }

    public function view(AuthUser $authUser, Gelar $gelar): bool
    {
        return $authUser->can('View:Gelar');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Gelar');
    }

    public function update(AuthUser $authUser, Gelar $gelar): bool
    {
        return $authUser->can('Update:Gelar');
    }

    public function delete(AuthUser $authUser, Gelar $gelar): bool
    {
        return $authUser->can('Delete:Gelar');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Gelar');
    }

}