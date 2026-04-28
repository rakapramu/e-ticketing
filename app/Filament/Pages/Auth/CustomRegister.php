<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomRegister extends Register
{
    protected function handleRegistration(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $user = $this->getUserModel()::create($data);

            $user->assignRole('partisipan');

            // 2. Simpan ke tabel kedua (misal: Profile)
            $user->peserta()->create([
                'user_id' => $user->id
            ]);

            return $user;
        });
    }
}
