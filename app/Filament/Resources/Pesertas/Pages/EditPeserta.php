<?php

namespace App\Filament\Resources\Pesertas\Pages;

use App\Filament\Resources\Pesertas\PesertaResource;
// use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPeserta extends EditRecord
{
    protected static string $resource = PesertaResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         DeleteAction::make(),
    //     ];
    // }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $this->record->user?->name;
        $data['email'] = $this->record->user?->email;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->record->user?->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        unset($data['user']);

        return $data;
    }
}
