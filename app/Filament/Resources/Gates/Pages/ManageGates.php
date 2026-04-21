<?php

namespace App\Filament\Resources\Gates\Pages;

use App\Filament\Resources\Gates\GateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageGates extends ManageRecords
{
    protected static string $resource = GateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
