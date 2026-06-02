<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AbstracAdmission;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbstracAdmissionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole('partisipan') || $authUser->can('ViewAny:AbstracAdmission');
    }

    public function view(AuthUser $authUser, AbstracAdmission $abstracAdmission): bool
    {
        return $authUser->hasRole('partisipan') || $authUser->can('View:AbstracAdmission');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AbstracAdmission');
    }

    public function update(AuthUser $authUser, AbstracAdmission $abstracAdmission): bool
    {
        return $authUser->can('Update:AbstracAdmission');
    }

    public function delete(AuthUser $authUser, AbstracAdmission $abstracAdmission): bool
    {
        return $authUser->can('Delete:AbstracAdmission');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AbstracAdmission');
    }

}