<?php

namespace App\Filament\Resources\RegisUlangs\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
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

                TextColumn::make('name')
                    ->label('Nama Event')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('regis_ulang_count')
                    ->label('Jumlah Regis')
                    ->counts('regisUlang')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'gray')
                    ->formatStateUsing(fn ($state) => "{$state} Peserta")
                    ->sortable(),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                Filter::make('has_regis')
                    ->label('Hanya Event dengan Registrasi')
                    ->query(fn ($query) => $query->has('regisUlang')),
            ])
            ->recordActions([
                Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->modalHeading(fn ($record) => "Detail Registrasi Ulang: {$record->name}")
                    ->modalDescription('Daftar peserta yang telah melakukan registrasi ulang di venue.')
                    ->modalWidth('4xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->modalContent(fn ($record) => view('filament.pages.regis-ulang-detail-modal', [
                        'event' => $record,
                        'regisUlangs' => $record->regisUlang()
                            ->with(['order.peserta.user', 'gate'])
                            ->latest('waktu')
                            ->get(),
                    ])),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
