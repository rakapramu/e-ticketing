<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                MarkdownEditor::make('description')
                    ->required(),
                FileUpload::make('foto')
                    ->image()
                    ->disk('public')
                    ->required()
                    ->directory('events')
                    ->visibility('public')
                    ->required(fn(string $context): bool => $context === 'create')
                    ->afterStateUpdated(function ($state, $record) {
                        if ($record && $record->foto && $state !== $record->foto) {
                            Storage::disk('public')->delete($record->foto);
                        }
                    }),
                Toggle::make('is_active'),
            ]);
    }
}
