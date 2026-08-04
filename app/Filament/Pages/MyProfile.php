<?php

namespace App\Filament\Pages;

use App\Models\Gelar;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema; // Gunakan Schema untuk v5
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.my-profile';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;

    public static function canAccess(): bool
    {
        return auth()->user()->can('View:MyProfile');
    }

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $peserta = $user->peserta;
        $formData = [
            'email' => $user->email,
            'name' => $user->name,
        ];
        if ($peserta) {
            $formData = array_merge($peserta->toArray(), $formData);
        }

        $this->form->fill($formData);
    }
    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make()
                    ->schema([
                        FileUpload::make('avatar_url')
                            ->label('')
                            ->image()
                            ->avatar()
                            ->alignCenter()
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            TextInput::make('id_participant')->disabled(),
                            TextInput::make('email')->required()->disabled(),
                            TextInput::make('name')->required(),
                            TextInput::make('nik')->label('NIK')->required()
                                ->rule('digits:16')
                                ->maxLength(16)
                                ->inputMode('numeric'),
                            Select::make('gelar_id')
                                ->label('Title')
                                ->required()
                                ->searchable()
                                ->options(Gelar::all()->pluck('name', 'id')),
                            TextInput::make('title_of_specialist')->label('Title of Specialist')->required(),
                            Select::make('participant_type')
                                ->options([
                                    'urologist' => 'Urologist',
                                    'resident' => 'Resident',
                                    'general_practitioner' => 'General Practitioner',
                                    'other_specialist' => 'Other Specialist',
                                    'medical_student' => 'Medical Student',
                                ]),
                            TextInput::make('name_on_certificate')->required(),
                            TextInput::make('institution')->required(),
                            TextInput::make('division')->required(),
                            Textarea::make('alamat')->label('Address')->required(),
                            Select::make('province_id')
                                ->label('Province / State')
                                ->options(fn() => DB::table('id_provinces')->pluck('name', 'code'))
                                ->searchable()
                                ->live()
                                ->required()
                                ->afterStateUpdated(fn(Set $set) => $set('city_id', null)),

                            Select::make('city_id')
                                ->label('City')
                                ->options(function (Get $get): Collection {
                                    $provinceCode = $get('province_id');

                                    if (! $provinceCode) {
                                        return collect();
                                    }

                                    return DB::table('id_cities')
                                        ->where('province_code', $provinceCode)
                                        ->pluck('name', 'code');
                                })
                                ->searchable()
                                ->required()
                                ->key(fn(Get $get) => "city-for-{$get('province_id')}")
                                ->placeholder(fn(Get $get) => $get('province_id') ? 'Select a city' : 'Select a province first'),
                            TextInput::make('country')->required(),
                            TextInput::make('postal_code'),
                            TextInput::make('no_wa')->label('Phone')->tel()->required(),
                        ]),
                    ]),

                Section::make('Ubah Password / Change Password')
                    ->description('Kosongkan jika tidak ingin mengubah password / Leave empty if you do not want to change password')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('current_password')
                                ->label('Password Saat Ini / Current Password')
                                ->password()
                                ->revealable()
                                ->required(fn (Get $get) => filled($get('new_password')))
                                ->rules([
                                    fn (Get $get) => function (string $attribute, $value, $fail) {
                                        if (filled($value) && !Hash::check($value, Auth::user()->password)) {
                                            $fail('Password saat ini tidak cocok.');
                                        }
                                    },
                                ]),
                            TextInput::make('new_password')
                                ->label('Password Baru / New Password')
                                ->password()
                                ->revealable()
                                ->required(fn (Get $get) => filled($get('current_password')))
                                ->minLength(8)
                                ->same('new_password_confirmation'),
                            TextInput::make('new_password_confirmation')
                                ->label('Konfirmasi Password Baru / Confirm New Password')
                                ->password()
                                ->revealable()
                                ->required(fn (Get $get) => filled($get('new_password'))),
                        ])
                    ])
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();

        // 1. Update password if new password is provided
        if (filled($data['new_password'] ?? null)) {
            $user->update([
                'password' => Hash::make($data['new_password']),
            ]);
        }

        // 2. Update name in user model to keep in sync
        if (filled($data['name'] ?? null)) {
            $user->update([
                'name' => $data['name'],
            ]);
        }

        // 3. Filter out password fields and email before updating peserta
        $pesertaData = collect($data)
            ->except(['current_password', 'new_password', 'new_password_confirmation', 'email'])
            ->toArray();

        $user->peserta()->updateOrCreate(
            ['user_id' => $user->id],
            $pesertaData
        );

        // 4. Clear the password fields so they are empty in the form after saving
        $this->form->fill(array_merge(
            $user->peserta ? $user->peserta->toArray() : [],
            [
                'email' => $user->email,
                'name' => $user->name,
                'current_password' => null,
                'new_password' => null,
                'new_password_confirmation' => null,
            ]
        ));

        Notification::make()
            ->title('Profil diperbarui')
            ->success()
            ->send();
    }
}
