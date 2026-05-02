<?php

namespace App\Filament\Resources\AbstracAdmissions\Pages;

use App\Filament\Resources\AbstracAdmissions\AbstracAdmissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;

class ManageAbstracAdmissions extends ManageRecords
{
    protected static string $resource = AbstracAdmissionResource::class;

    protected function getHeaderActions(): array
    {
        if (Auth::user()->hasRole('partisipan')) {
            return [
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $user = Auth::user();
                        $peserta = $user->peserta;

                        if (!$peserta) {
                            throw new \Exception('Peserta tidak ditemukan');
                        }

                        $data['peserta_id'] = $peserta->id;
                        $data['status'] = 'unvalidated';

                        return $data;
                    }),
            ];
        }

        return [];
    }
}
