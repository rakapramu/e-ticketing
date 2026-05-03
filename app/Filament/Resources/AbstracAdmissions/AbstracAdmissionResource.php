<?php

namespace App\Filament\Resources\AbstracAdmissions;

use App\Filament\Resources\AbstracAdmissions\Pages\ManageAbstracAdmissions;
use App\Models\AbstracAdmission;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AbstracAdmissionResource extends Resource
{
    protected static ?string $model = AbstracAdmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'AbstracAdmission';

    protected static ?string $navigationLabel = 'Abstarct Submissions';

    protected static ?string $pluralLabel = 'Abstract Submissions';
    protected static ?string $label = 'Abstract Submission';

    public static function shouldRegisterNavigation(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();

        if ($user->hasRole('partisipan')) {
            return $user->peserta()
                ->whereHas('order', function ($q) {
                    $q->where('status', 'success')
                        ->whereHas('event.category', function ($q2) {
                            $q2->where('name', 'Symposium');
                        });
                })
                ->exists();
        }

        return true;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('file')
                    ->disk('public')
                    ->columnSpanFull()
                    ->directory('abstrac_admissions')
                    ->visibility('public')
                    ->afterStateUpdated(function ($state, $record) {
                        if ($record && $record->foto && $state !== $record->foto) {
                            Storage::disk('public')->delete($record->file);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('AbstracAdmission')
            ->columns([
                TextColumn::make('judul')
                    ->searchable(),
                TextColumn::make('peserta.user.name')
                    ->label('Peserta')
                    ->searchable(),
                TextColumn::make('file')
                    ->label('File')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '-';
                        }

                        $url = asset('storage/' . $state);

                        return "<a href='{$url}' target='_blank'
                    class='inline-flex items-center px-3 py-3 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700'>
                    Lihat File
                </a>";
                    })
                    ->html(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'validated' => 'success',
                        'unvalidated' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->formatStateUsing(fn($state) => $state->format('d F Y')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                // DeleteAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn(AbstracAdmission $record) => Auth::user()->hasRole('super_admin') && $record->status === 'unvalidated')
                    ->action(function (AbstracAdmission $record) {
                        DB::transaction(function () use ($record) {
                            $record->update(['status' => 'validated']);
                            Notification::make()->title('Abstrak Berhasil di-Approve')->success()->send();
                        });
                    }),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAbstracAdmissions::route('/'),
        ];
    }
}
