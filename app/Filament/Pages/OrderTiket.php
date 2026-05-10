<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\CategoryEvent;
use App\Models\Event;
use App\Models\Order;
use App\Models\KodeKupon; // Pastikan Model diimport
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderTiket extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Ticket;
    protected string $view = 'filament.pages.order-tiket';

    public $coupon_code = '';

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
            ->form([
                TextInput::make('coupon_code')
                    ->label('Kode Kupon (Opsional)')
                    ->placeholder('Masukkan kode jika ada')
            ])
            ->action(function (array $arguments, array $data) { // Tambahkan $data untuk ambil input form
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
                    DB::transaction(function () use ($user, $peserta, $event, $data) {
                        $orderCode = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(str()->random(5));
                        $uniqueCode = random_int(100, 999);
                        $discount = 0;
                        $couponId = null;

                        // --- LOGIKA KUPON ---
                        if (!empty($data['coupon_code'])) {
                            $coupon = KodeKupon::where('kode', $data['coupon_code'])
                                ->where('is_active', true)
                                ->first();

                            if (!$coupon) {
                                throw new \Exception('Kode kupon tidak valid.');
                            }

                            // 1. Cek Relasi Kupon ke Event
                            if (!$coupon->events->contains($event->id)) {
                                throw new \Exception('Kupon tidak berlaku untuk event ini.');
                            }

                            // 2. Cek Limit Kupon (Global)
                            $totalUsed = Order::where('kode_kupon_id', $coupon->id)
                                ->whereIn('status', ['pending', 'waiting_approval', 'success'])
                                ->count();

                            if ($coupon->limit > 0 && $totalUsed >= $coupon->limit) {
                                throw new \Exception('Kuota kupon sudah habis.');
                            }

                            // 3. Cek Limit User (Per Partisipan)
                            $userUsedCount = Order::where('kode_kupon_id', $coupon->id)
                                ->where('peserta_id', $peserta->id)
                                ->whereIn('status', ['pending', 'waiting_approval', 'success'])
                                ->count();

                            if ($coupon->limit_user > 0 && $userUsedCount >= $coupon->limit_user) {
                                throw new \Exception('Anda sudah mencapai batas pemakaian kupon ini.');
                            }

                            $discount = $coupon->diskon;
                            $couponId = $coupon->id;
                        }

                        $finalTotal = max(0, ($event->final_price - $discount) + $uniqueCode);

                        Order::create([
                            'order_code'    => $orderCode,
                            'peserta_id'    => $peserta->id,
                            'event_id'      => $event->id,
                            'kode_kupon_id' => $couponId,
                            'qty'           => 1,
                            'kode_unik'     => $uniqueCode,
                            'total'         => $finalTotal,
                            'status'        => 'pending',
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
                        ->title('Gagal Memproses Pesanan')
                        ->body($e->getMessage()) // Menampilkan pesan error validasi kupon
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
