<?php

namespace App\Filament\Resources\KodeKupons\Pages;

use App\Filament\Resources\KodeKupons\KodeKuponResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKodeKupon extends EditRecord
{
    protected static string $resource = KodeKuponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
