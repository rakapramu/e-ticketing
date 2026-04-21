<?php

namespace App\Filament\Resources\Pesertas\Pages;

use App\Filament\Resources\Pesertas\PesertaResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreatePeserta extends CreateRecord
{
    protected static string $resource = PesertaResource::class;


    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('peserta'),
            ]);

            $data['user_id'] = $user->id;
            return static::getModel()::create($data);
        });
    }
}
