<?php

namespace App\Filament\Resources\RegisUlangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegisUlangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('order.event.name')
                    ->label('Event')
                    ->searchable(),
                TextColumn::make('gate.nama')
                    ->searchable(),
                TextColumn::make('order.created_at')
                    ->label('Tanggal Pemesanan')
                    ->date('d F Y'),
                TextColumn::make('created_at')
                    ->label('Tanggal Registrasi')
                    ->date('d F Y'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
