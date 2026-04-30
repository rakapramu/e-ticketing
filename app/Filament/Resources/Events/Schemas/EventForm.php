<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\CategoryEvent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
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
                Section::make('Detail Event')
                    ->description('Lengkapi informasi utama event di bawah ini.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->columnSpan(2),
                        Select::make('category_id')
                            ->options(CategoryEvent::all()->pluck('name', 'id'))
                            ->columnSpan(2)
                            ->required()
                            ->searchable(),
                        MarkdownEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Media & Status')
                    ->schema([
                        FileUpload::make('foto')
                            ->image()
                            ->disk('public')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->directory('events')
                            ->visibility('public')
                            ->required(fn(string $context): bool => $context === 'create')
                            ->afterStateUpdated(function ($state, $record) {
                                if ($record && $record->foto && $state !== $record->foto) {
                                    Storage::disk('public')->delete($record->foto);
                                }
                            }),
                        Toggle::make('is_active')
                            ->label('Publikasikan Event')
                            ->default(false),
                    ]),

                Section::make('Harga & Konfigurasi Diskon')
                    ->schema([
                        TextInput::make('price')
                            ->label('Harga Normal')
                            ->numeric()
                            ->prefix('Rp.')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, Get $get) => self::calculateFinalPrice($set, $get)),

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
                            ->label('Potongan Harga')
                            ->numeric()
                            ->prefix('Rp.')
                            ->default(0)
                            ->visible(fn(Get $get): bool => $get('is_diskon'))
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, Get $get) => self::calculateFinalPrice($set, $get)),

                        TextInput::make('final_price')
                            ->label('Harga Akhir')
                            ->numeric()
                            ->prefix('Rp.')
                            ->readOnly()
                            ->placeholder(fn(Get $get) => $get('price')),
                    ])
                    ->columns(1)
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
