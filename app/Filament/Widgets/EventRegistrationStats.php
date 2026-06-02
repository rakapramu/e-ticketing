<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventRegistrationStats extends BaseWidget
{
    protected ?string $pollingInterval = '10s';

    public static function canView(): bool
    {
        return auth()->user()?->can('View:EventRegistrationStats');
    }

    protected function getStats(): array
    {
        $events = Event::with('order')->get();

        $stats = [];

        foreach ($events as $event) {
            $total = $event->order->whereIn('status', ['pending', 'success'])->count();
            $pending = $event->order->where('status', 'pending')->count();
            $approve = $event->order->where('status', 'success')->count();

            $stats[] = Stat::make("Total Peserta : {$event->name}", (string) $total)
                ->description("Pending {$pending} | Approve {$approve}")
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info');
        }

        if (empty($stats)) {
            $stats[] = Stat::make('Data Event', '0')
                ->description('Belum ada event aktif')
                ->color('gray');
        }

        return $stats;
    }
}
