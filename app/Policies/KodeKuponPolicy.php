<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\KodeKupon;
use Illuminate\Auth\Access\HandlesAuthorization;

class KodeKuponPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:KodeKupon');
    }

    public function view(AuthUser $authUser, KodeKupon $kodeKupon): bool
    {
        return $authUser->can('View:KodeKupon');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:KodeKupon');
    }

    public function update(AuthUser $authUser, KodeKupon $kodeKupon): bool
    {
        return $authUser->can('Update:KodeKupon');
    }

    public function delete(AuthUser $authUser, KodeKupon $kodeKupon): bool
    {
        return $authUser->can('Delete:KodeKupon');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:KodeKupon');
    }

}