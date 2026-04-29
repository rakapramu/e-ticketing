<?php

namespace App\Filament\Resources\Pesertas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PesertasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('nik'),
                TextColumn::make('user.name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('no_wa')
                    ->searchable(),
                TextColumn::make('gelar.name')
                    ->label('Gelar'),
                TextColumn::make('alamat')

            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->each(function ($record) {
                                $record->user?->delete();
                            });
                        }),
                ]),
            ]);
    }
}
