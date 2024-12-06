<?php

namespace App\Filament\Resources\ChaineResource\Pages;

use App\Filament\Resources\ChaineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChaine extends EditRecord
{
    protected static string $resource = ChaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
