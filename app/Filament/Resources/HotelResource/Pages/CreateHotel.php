<?php

namespace App\Filament\Resources\HotelResource\Pages;

use App\Filament\Resources\HotelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotel extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = HotelResource::class;

    protected function getRedirectUrl(): string
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
<<<<<<< HEAD
        return $data;
    }
}
=======
        dd($data);
        return $data;
    }
}
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
