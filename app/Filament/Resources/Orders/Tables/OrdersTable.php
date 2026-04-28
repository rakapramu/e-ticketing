<?php

namespace App\Filament\Resources\Orders\Tables;

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

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
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
                Action::make('upload_payment')
                    ->label('Upload Bukti')
                    ->icon('heroicon-m-arrow-up-tray')
                    ->visible(fn($record) => $record->status === 'pending' && auth()->user()->hasRole('partisipan'))
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
                    ->visible(fn() => Auth::user()->can('ViewPayment'))
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
                        $record->update(['status' => 'success']);
                        Notification::make()->title('Order Berhasil di-Approve')->success()->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
