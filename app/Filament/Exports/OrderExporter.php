<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            // Order details
            ExportColumn::make('order_code')
                ->label('Kode Order'),
            ExportColumn::make('event.name')
                ->label('Nama Event'),
            ExportColumn::make('qty')
                ->label('Qty'),
            ExportColumn::make('total')
                ->label('Total Bayar'),
            ExportColumn::make('status')
                ->label('Status Order'),
            ExportColumn::make('kodeKupon.kode')
                ->label('Kupon Diskon'),
            ExportColumn::make('created_at')
                ->label('Tanggal Order'),

            // Participant details
            ExportColumn::make('peserta.id_participant')
                ->label('ID Peserta'),
            ExportColumn::make('peserta.user.name')
                ->label('Nama Peserta'),
            ExportColumn::make('peserta.user.email')
                ->label('Email Peserta'),
            ExportColumn::make('peserta.no_wa')
                ->label('Nomor WhatsApp'),
            ExportColumn::make('peserta.nik')
                ->label('NIK'),
            ExportColumn::make('peserta.tanggal_lahir')
                ->label('Tanggal Lahir'),
            ExportColumn::make('peserta.title_of_specialist')
                ->label('Gelar / Spesialis'),
            ExportColumn::make('peserta.name_on_certificate')
                ->label('Nama pada Sertifikat'),
            ExportColumn::make('peserta.institution')
                ->label('Institusi / Instansi'),
            ExportColumn::make('peserta.division')
                ->label('Divisi / Bagian'),
            ExportColumn::make('peserta.participant_type')
                ->label('Tipe Peserta'),
            ExportColumn::make('peserta.alamat')
                ->label('Alamat'),
            ExportColumn::make('peserta.province.name')
                ->label('Provinsi'),
            ExportColumn::make('peserta.city.name')
                ->label('Kota/Kabupaten'),
            ExportColumn::make('peserta.country')
                ->label('Negara'),
            ExportColumn::make('peserta.postal_code')
                ->label('Kode Pos'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
