<?php

namespace App\Filament\Resources\KodeKupons\Pages;

use App\Filament\Resources\KodeKupons\KodeKuponResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKodeKupons extends ListRecords
{
    protected static string $resource = KodeKuponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
