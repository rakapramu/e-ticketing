<?php

namespace App\Filament\Resources\RegisUlangs;

use App\Filament\Resources\RegisUlangs\Pages\CreateRegisUlang;
use App\Filament\Resources\RegisUlangs\Pages\EditRegisUlang;
use App\Filament\Resources\RegisUlangs\Pages\ListRegisUlangs;
use App\Filament\Resources\RegisUlangs\Schemas\RegisUlangForm;
use App\Filament\Resources\RegisUlangs\Tables\RegisUlangsTable;
use App\Models\RegisUlang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegisUlangResource extends Resource
{
    protected static ?string $model = RegisUlang::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'RegisUlang';

    public static function form(Schema $schema): Schema
    {
        return RegisUlangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegisUlangsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegisUlangs::route('/'),
            'create' => CreateRegisUlang::route('/create'),
            'edit' => EditRegisUlang::route('/{record}/edit'),
        ];
    }
}
