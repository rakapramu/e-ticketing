<?php

namespace App\Filament\Resources\RegisUlangs;

use App\Filament\Resources\RegisUlangs\Pages\ListRegisUlangs;
use App\Filament\Resources\RegisUlangs\Schemas\RegisUlangForm;
use App\Filament\Resources\RegisUlangs\Tables\RegisUlangsTable;
use App\Models\RegisUlangEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RegisUlangResource extends Resource
{
    protected static ?string $model = RegisUlangEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Regis Ulangs';

    protected static ?string $pluralLabel = 'Regis Ulangs';

    protected static ?string $label = 'Regis Ulang';

    protected static ?string $slug = 'regis-ulangs';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('ViewAny:RegisUlang') ?? false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

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
        ];
    }
}
