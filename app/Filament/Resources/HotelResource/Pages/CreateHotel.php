<?php

namespace App\Filament\Resources\HotelResource\Pages;

use App\Filament\Resources\HotelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotel extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = HotelResource::class;

    protected function  getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }

    public function mutateFormDataBeforeCreate(array $data): array
    {
        dd($data);
        return $data;
    }
}
