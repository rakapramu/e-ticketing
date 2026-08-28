<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Event;
use App\Models\Order;
use App\Models\RegisUlang;
use App\Models\Gate;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SelfCheckin extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-camera';

    protected string $view = 'filament.pages.self-checkin';

    protected static ?string $navigationLabel = 'Self Checkin';
    
    protected static ?string $title = 'Self Check-in Event';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->peserta !== null;
    }

    public $isServerProcessing = false;

    public function processScan($eventId)
    {
        if ($this->isServerProcessing) return;
        $this->isServerProcessing = true;

        if (!$eventId) {
            $this->isServerProcessing = false;
            return;
        }

        $user = Auth::user();
        $peserta = $user->peserta;

        if (!$peserta) {
            $this->dispatch('scan-processed', result: [
                'success' => false,
                'message' => 'Anda belum terdaftar sebagai peserta.',
                'name' => $user->name,
            ]);
            $this->isServerProcessing = false;
            return;
        }

        // Temukan order yang success untuk peserta ini dan event ini
        $order = Order::where('peserta_id', $peserta->id)
            ->where('event_id', $eventId)
            ->where('status', 'success')
            ->first();

        if (!$order) {
            $this->dispatch('scan-processed', result: [
                'success' => false,
                'message' => 'Anda tidak memiliki tiket aktif untuk event ini.',
                'name' => $peserta->name ?? $user->name,
            ]);
            $this->isServerProcessing = false;
            return;
        }

        // Cek apakah sudah pernah check-in
        if (RegisUlang::where('order_id', $order->id)->exists()) {
            $regis = RegisUlang::where('order_id', $order->id)->first();
            $this->dispatch('scan-processed', result: [
                'success' => false,
                'message' => 'Anda sudah check-in sebelumnya pada ' . Carbon::parse($regis->waktu)->format('d-m-Y H:i'),
                'name' => $peserta->name ?? $user->name,
            ]);
            $this->isServerProcessing = false;
            return;
        }

        // Cari atau buat Gate 'Self Checkin'
        $gate = Gate::firstOrCreate(['name' => 'Self Checkin']);

        RegisUlang::create([
            'order_id' => $order->id,
            'gate_id' => $gate->id,
            'waktu' => Carbon::now(),
        ]);

        $this->dispatch('scan-processed', result: [
            'success' => true,
            'message' => 'Check-in Berhasil! Silakan masuk.',
            'name' => $peserta->name ?? $user->name,
        ]);

        Notification::make()
            ->title('Check-in Berhasil')
            ->success()
            ->send();

        $this->isServerProcessing = false;
    }
}
