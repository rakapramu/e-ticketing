<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make(),
    //     ];
    // }
    public function getHeader(): ?View
    {
        return view('filament.resource.order-resource.widget.payment-info');
    }
}
