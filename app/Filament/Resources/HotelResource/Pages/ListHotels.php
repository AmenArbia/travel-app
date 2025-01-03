<?php

namespace App\Filament\Resources\HotelResource\Pages;

use App\Filament\Resources\HotelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;


class ListHotels extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = HotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}