<?php

namespace App\Filament\Resources\RegisUlangs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RegisUlangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('peserta_id')
                    ->required(),
                TextInput::make('event_id')
                    ->required(),
                TextInput::make('gate_id')
                    ->required(),
                DateTimePicker::make('waktu')
                    ->required(),
            ]);
    }
}
