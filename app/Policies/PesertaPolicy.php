<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Peserta;
use Illuminate\Auth\Access\HandlesAuthorization;

class PesertaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Peserta');
    }

    public function view(AuthUser $authUser, Peserta $peserta): bool
    {
        return $authUser->can('View:Peserta');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Peserta');
    }

    public function update(AuthUser $authUser, Peserta $peserta): bool
    {
        return $authUser->can('Update:Peserta');
    }

    public function delete(AuthUser $authUser, Peserta $peserta): bool
    {
        return $authUser->can('Delete:Peserta');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Peserta');
    }

}