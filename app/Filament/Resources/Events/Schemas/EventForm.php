<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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
                    ->prefix('Rp.')
                    ->live()
                    ->afterStateUpdated(fn(Set $set, Get $get) => self::calculateFinalPrice($set, $get)),
                MarkdownEditor::make('description')
                    ->required(),
                FileUpload::make('foto')
                    ->image()
                    ->disk('public')
                    ->directory('events')
                    ->visibility('public')
                    ->required(fn(string $context): bool => $context === 'create')
                    ->afterStateUpdated(function ($state, $record) {
                        if ($record && $record->foto && $state !== $record->foto) {
                            Storage::disk('public')->delete($record->foto);
                        }
                    }),

                Toggle::make('is_diskon')
                    ->label('Aktifkan Diskon?')
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        if (!$state) {
                            $set('diskon', 0);
                            self::calculateFinalPrice($set, $get);
                        }
                    }),

                TextInput::make('diskon')
                    ->label('Potongan Harga ($)')
                    ->numeric()
                    ->default(0)
                    ->visible(fn(Get $get): bool => $get('is_diskon')) // Muncul hanya jika is_diskon TRUE
                    ->live(onBlur: true) // Update saat user selesai mengetik (kehilangan fokus)
                    ->afterStateUpdated(fn(Set $set, Get $get) => self::calculateFinalPrice($set, $get)),

                TextInput::make('final_price')
                    ->label('Harga Akhir')
                    ->numeric()
                    ->prefix('$')
                    ->readOnly() // User tidak boleh input manual di sini
                    ->placeholder(fn(Get $get) => $get('price')), // Default ke harga normal jika tidak ada diskon

                Toggle::make('is_active'),
            ]);
    }

    /**
     * Fungsi pembantu untuk menghitung harga akhir
     */
    public static function calculateFinalPrice(Set $set, Get $get): void
    {
        $price = (float) $get('price');
        $diskon = (float) $get('diskon');

        // Pastikan diskon tidak lebih besar dari harga asli
        if ($diskon > $price) {
            $diskon = $price;
            $set('diskon', $diskon);
        }

        $set('final_price', $price - $diskon);
    }
}
