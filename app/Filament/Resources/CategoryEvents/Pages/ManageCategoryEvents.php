<?php

namespace App\Filament\Resources\CategoryEvents\Pages;

use App\Filament\Resources\CategoryEvents\CategoryEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCategoryEvents extends ManageRecords
{
    protected static string $resource = CategoryEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
