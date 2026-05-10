<?php

namespace App\Filament\Resources\KodeKupons;

use App\Filament\Resources\KodeKupons\Pages\CreateKodeKupon;
use App\Filament\Resources\KodeKupons\Pages\EditKodeKupon;
use App\Filament\Resources\KodeKupons\Pages\ListKodeKupons;
use App\Filament\Resources\KodeKupons\Schemas\KodeKuponForm;
use App\Filament\Resources\KodeKupons\Tables\KodeKuponsTable;
use App\Models\KodeKupon;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KodeKuponResource extends Resource
{
    protected static ?string $model = KodeKupon::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'KodeKupon';

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin');
    }

    public static function form(Schema $schema): Schema
    {
        return KodeKuponForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KodeKuponsTable::configure($table);
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
            'index' => ListKodeKupons::route('/'),
            'create' => CreateKodeKupon::route('/create'),
            'edit' => EditKodeKupon::route('/{record}/edit'),
        ];
    }
}
