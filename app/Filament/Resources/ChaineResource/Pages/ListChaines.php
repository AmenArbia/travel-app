<?php

namespace App\Filament\Resources\ChaineResource\Pages;

use App\Filament\Resources\ChaineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChaines extends ListRecords
{
    protected static string $resource = ChaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
