<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventRegistrationStats extends BaseWidget
{
    protected ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        $events = Event::withCount('regisUlang')->get();

        $stats = [];

        foreach ($events as $event) {
            $stats[] = Stat::make("Event : {$event->name}", $event->regis_ulang_count)
                ->description("Total peserta regis ulang")
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success');
        }

        if (empty($stats)) {
            $stats[] = Stat::make('Data Event', '0')
                ->description('Belum ada event aktif')
                ->color('gray');
        }

        return $stats;
    }
}
