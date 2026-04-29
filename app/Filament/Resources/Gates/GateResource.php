<?php

namespace App\Filament\Resources\Gates;

use App\Filament\Resources\Gates\Pages\ManageGates;
use App\Models\Gate;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GateResource extends Resource
{
    protected static ?string $model = Gate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQrCode;

    protected static ?string $recordTitleAttribute = 'Gate';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('lokasi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Gate')
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('lokasi')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('Scan Camera')
                    ->url(fn(Gate $record): string => route('gate', $record->id))
                    ->icon('heroicon-s-link')
                    ->color('primary')
                    ->openurlInNewTab(),
                Action::make('Scan Scanner')
                    ->url(fn(Gate $record): string => route('scanner', $record->id))
                    ->icon('heroicon-s-link')
                    ->color('success')
                    ->openurlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageGates::route('/'),
        ];
    }
}
