<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Mail\TicketMail;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // ->header(function () {
            //     return view('filament.resource.order-resource.widget.payment-info');
            // })
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('order_code')
                    ->label('Order Code')
                    ->searchable(),
                TextColumn::make('peserta.user.name')
                    ->label('Peserta')
                    ->searchable(),
                TextColumn::make('event.name')
                    ->label('Event')
                    ->searchable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->getStateUsing(fn($record) => $record->status)
                    ->color(fn($state) => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                    }),
                // munculkan tanggal format 8 Februaru 2027
                TextColumn::make('created_at')
                    ->label('Tanggal Pemesanan')
                    ->getStateUsing(fn($record) => $record->created_at->format('d F Y'))
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                Action::make('download_invoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('gray')
                    ->url(fn(Order $record): string => route('invoice.download', $record))
                    ->visible(fn($record) => $record->status === 'success')
                    ->openUrlInNewTab(),
                Action::make('download_qr')
                    ->label('Download QR')
                    ->icon('heroicon-o-qr-code')
                    ->color('gray')
                    ->visible(fn($record) => $record->status === 'success')
                    ->url(fn(Order $record): string => route('ticket', $record))
                    ->openUrlInNewTab(),
                Action::make('upload_payment')
                    ->label('Upload Bukti')
                    ->icon('heroicon-m-arrow-up-tray')
                    ->visible(
                        fn($record) =>
                        auth()->user()->hasRole('partisipan') &&
                            $record->status === 'pending' &&
                            $record->payment_order === null
                    )
                    ->form([
                        FileUpload::make('payment_order')
                            ->label('Foto Bukti Transfer')
                            ->disk('public')
                            ->image()
                            ->required()
                            ->directory('bukti_transfer'),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'payment_order' => $data['payment_order'],
                        ]);

                        Notification::make()->title('Bukti Transfer Berhasil di-Upload')->success()->send();
                    }),

                Action::make('view_payment')
                    ->label('Cek Bukti')
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->visible(fn($record) => Auth::user()->can('ViewPayment') && $record->payment_order != null)
                    ->modalContent(fn(Order $record) => view('filament.components.view-payment-proof', ['record' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalWidth('lg'),

                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn(Order $record) => Auth::user()->can('ApprovePayment') && $record->status === 'pending')
                    ->action(function (Order $record) {
                        DB::transaction(function () use ($record) {
                            $record->update(['status' => 'success']);
                            Mail::to($record->peserta->user->email)->send(
                                new TicketMail($record)
                            );
                            Notification::make()->title('Order Berhasil di-Approve')->success()->send();
                        });
                    }),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
