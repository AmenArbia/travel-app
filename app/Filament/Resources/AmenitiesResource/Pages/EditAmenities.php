<?php

namespace App\Filament\Resources\AmenitiesResource\Pages;

use App\Filament\Resources\AmenitiesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmenities extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = AmenitiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }



    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }
}
