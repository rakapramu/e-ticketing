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
    public $isServerProcessing = false;

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
        if ($this->isServerProcessing) return;
        $this->isServerProcessing = true;

        if (!$this->gate_id) {
            Notification::make()
                ->title('Peringatan')
                ->body('Silakan pilih Gate terlebih dahulu.')
                ->warning()
                ->send();
            $this->isServerProcessing = false;
            return;
        }

        if (!$code) {
            $this->isServerProcessing = false;
            return;
        }

        $order = Order::with('regisUlang', 'peserta')->where('order_code', $code)->first();

        if (!$order) {
            $result = ['success' => false, 'message' => 'Kode tidak ditemukan', 'name' => 'TIDAK DIKENAL'];
        } elseif ($order->status !== 'success') {
            $result = ['success' => false, 'message' => 'Order belum lunas', 'name' => 'BELUM BAYAR'];
        } elseif ($order->regisUlang) {
            $result = ['success' => false, 'message' => 'Sudah masuk pd ' . $order->regisUlang->waktu, 'name' => 'SUDAH SCAN'];
        } else {
            // Berhasil: Simpan Data
            RegisUlang::create([
                'order_id' => $order->id,
                'gate_id'  => $this->gate_id,
                'waktu'    => Carbon::now()
            ]);

            $result = [
                'success' => true,
                'name' => $order->peserta->name,
                'message' => 'Silakan Masuk Venue'
            ];

            $this->dispatch('refresh-table');
        }

        // Kirim event balik ke Alpine.js
        $this->dispatch('scan-processed', result: $result);

        $this->isServerProcessing = false;
    }
}
