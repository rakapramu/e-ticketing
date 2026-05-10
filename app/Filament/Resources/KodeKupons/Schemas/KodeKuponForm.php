<?php

namespace App\Filament\Resources\KodeKupons\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class KodeKuponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('diskon')
                    ->label('Potongan Harga (IDR)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                TextInput::make('limit')
                    ->label('Total Kupon')
                    ->numeric()
                    ->helperText('Total ketersediaan kupon secara keseluruhan'),
                TextInput::make('limit_user')
                    ->label('Limit per User')
                    ->numeric()
                    ->default(1)
                    ->helperText('Berapa kali satu user dapat menggunakan kode ini'),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
                Select::make('events')
                    ->relationship('events', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),
            ]);
    }
}
