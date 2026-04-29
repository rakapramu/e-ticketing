<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\CategoryEvent;
use App\Models\Event;
use App\Models\Order;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderTiket extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Ticket;
    protected string $view = 'filament.pages.order-tiket';

    public static function canAccess(): bool
    {
        return auth()->user()->can('View:OrderTiket');
    }

    public function getCategories()
    {
        $data = CategoryEvent::query()
            ->with(['event' => function ($query) {
                $query->where('is_active', true);
            }])
            ->whereHas('event', function ($query) {
                $query->where('is_active', true);
            })
            ->get();

        return $data;
    }

    public function orderAction(): Action
    {
        return Action::make('order')
            ->label('Beli Tiket')
            ->icon('heroicon-s-ticket')
            ->color('primary')
            ->button()
            ->extraAttributes([
                'class' => 'rounded-xl px-8 shadow-md hover:shadow-primary-200 transition-all'
            ])
            ->requiresConfirmation()
            ->modalHeading('Konfirmasi Pemesanan')
            ->modalDescription('Apakah Anda yakin ingin memesan tiket ini?')
            ->modalSubmitActionLabel('Ya, Pesan Sekarang')
            ->action(function (array $arguments) {
                $user = Auth::user();
                $peserta = $user->peserta;
                $eventId = $arguments['ticketId'];

                if (!$peserta || !$this->isProfileComplete($peserta)) {
                    Notification::make()
                        ->title('Profil Belum Lengkap')
                        ->body('Silakan lengkapi profil Anda terlebih dahulu.')
                        ->danger()
                        ->actions([
                            Action::make('lengkapi_profil')
                                ->button()
                                ->url(fn() => MyProfile::getUrl())
                        ])
                        ->send();
                    return;
                }

                $event = Event::findOrFail($eventId);

                // CEK STOK
                if ($event->stock !== null && $event->stock <= 0) {
                    Notification::make()
                        ->title('Tiket Habis')
                        ->body('Maaf, kuota untuk event ini sudah penuh.')
                        ->danger()
                        ->send();
                    return;
                }

                // CEK DUPLIKAT
                $existingOrder = Order::where('peserta_id', $peserta->id)
                    ->where('event_id', $eventId)
                    ->whereIn('status', ['pending', 'success'])
                    ->exists();

                if ($existingOrder) {
                    Notification::make()
                        ->title('Sudah Terdaftar')
                        ->body('Anda sudah melakukan pemesanan untuk event ini.')
                        ->warning()
                        ->send();
                    return;
                }

                try {
                    DB::transaction(function () use ($user, $peserta, $event) {
                        $orderCode = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(str()->random(5));

                        Order::create([
                            'order_code' => $orderCode,
                            'peserta_id' => $peserta->id,
                            'event_id'   => $event->id,
                            'qty'        => 1,
                            'total'      => $event->price,
                            'status'     => 'pending',
                        ]);

                        if ($event->stock !== null) {
                            $event->decrement('stock');
                        }
                    });

                    Notification::make()
                        ->title('Pemesanan Berhasil')
                        ->body('Tiket Anda telah dipesan. Silakan cek menu riwayat untuk pembayaran.')
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Terjadi Kesalahan')
                        ->body('Gagal memproses pesanan. Silakan coba lagi.')
                        ->danger()
                        ->send();
                }
            });
    }

    protected function isProfileComplete($peserta): bool
    {
        return (bool) $peserta?->nik;
    }
}
