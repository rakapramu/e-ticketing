<?php

namespace App\Filament\Resources\RegisUlangs\Pages;

use App\Filament\Resources\RegisUlangs\RegisUlangResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRegisUlang extends EditRecord
{
    protected static string $resource = RegisUlangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
