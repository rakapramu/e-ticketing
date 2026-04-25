<?php

namespace App\Filament\Resources\RegisUlangs\Pages;

use App\Filament\Resources\RegisUlangs\RegisUlangResource;
use App\Models\Order;
use App\Models\RegisUlang;
use App\Models\Gate;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListRegisUlangs extends ListRecords
{
    protected static string $resource = RegisUlangResource::class;

    public $gate_id = null;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label('Refresh')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->action(fn() => null)
                ->extraAttributes(['wire:click' => '$refresh']),
            Action::make('scan_registration')
                ->label('Scan Barcode')
                ->icon('heroicon-o-qr-code')
                ->color('primary')
                ->modalHeading('Registrasi Ulang Peserta')
                ->modalContent(view('filament.pages.scan', [
                    'gates' => Gate::all(),
                ]))
                ->modalSubmitAction(false)
                ->modalWidth('md'),
        ];
    }

    public function processScan($code)
    {
        if (!$this->gate_id) {
            Notification::make()
                ->title('Peringatan')
                ->body('Silakan pilih Gate terlebih dahulu sebelum melakukan scan.')
                ->warning()
                ->send();
            return;
        }

        if (!$code) return;

        $order = Order::with('regisUlang')->where('order_code', strtoupper($code))->first();

        if (!$order) {
            Notification::make()->title('Gagal')->body('Kode tidak ditemukan')->danger()->send();
            return;
        }

        if ($order->status !== 'success') {
            Notification::make()->title('Gagal')->body('Order belum dibayar')->warning()->send();
            return;
        }

        if ($order->regisUlang) {
            Notification::make()
                ->title('Perhatian')
                ->body('Tiket sudah digunakan pada ' . $order->regisUlang->waktu)
                ->warning()
                ->send();
            return;
        }

        RegisUlang::create([
            'order_id' => $order->id,
            'gate_id'  => $this->gate_id,
            'waktu'    => Carbon::now()
        ]);

        Notification::make()
            ->title('Berhasil')
            ->body('Registrasi Berhasil untuk ' . $order->order_code . ' melalui Gate ' . (Gate::find($this->gate_id)?->name ?? ''))
            ->success()
            ->send();

        $this->dispatch('refresh-table');
    }
}
