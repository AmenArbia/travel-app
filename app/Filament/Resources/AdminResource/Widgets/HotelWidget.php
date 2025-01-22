<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HotelWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Hotels', Hotel::count())
                ->description('Number of hotels')
                ->descriptionIcon('heroicon-o-building-office', IconPosition::Before)
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('success'),

            Stat::make('Bookings', Booking::count())
                ->description('Number of Booking submitted')
                ->descriptionIcon('heroicon-o-document-check', IconPosition::Before)
                ->chart([1, 5, 30, 60, 40, 30, 20])
                ->color('info'),

            Stat::make('Users', User::count())
                ->description('Number of Users')
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->chart([1, 5, 20, 30, 40])
                ->color('warning'),
        ];
    }
}
