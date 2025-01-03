<?php

namespace App\Filament\Resources\HotelResource\Pages;

use App\Filament\Resources\HotelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotel extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = HotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}