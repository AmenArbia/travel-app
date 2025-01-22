<?php

namespace App\Filament\Resources\AmenitiesResource\Pages;

use App\Filament\Resources\AmenitiesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAmenities extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = AmenitiesResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }


}