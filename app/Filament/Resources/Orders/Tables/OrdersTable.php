<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')
                    ->label('Order Code')
                    ->searchable(),
                TextColumn::make('peserta.name')
                    ->label('Peserta')
                    ->searchable(),
                TextColumn::make('event.name')
                    ->label('Event')
                    ->searchable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->getStateUsing(fn($record) => $record->status)
                    ->color(fn($state) => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                    }),
                // munculkan tanggal format 8 Februaru 2027
                TextColumn::make('created_at')
                    ->label('Tanggal Pemesanan')
                    ->getStateUsing(fn($record) => $record->created_at->format('d F Y'))
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
