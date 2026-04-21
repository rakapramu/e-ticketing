<?php

namespace App\Filament\Resources\RegisUlangs\Pages;

use App\Filament\Resources\RegisUlangs\RegisUlangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRegisUlangs extends ListRecords
{
    protected static string $resource = RegisUlangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
