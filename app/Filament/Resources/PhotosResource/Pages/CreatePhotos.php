<?php

namespace App\Filament\Resources\PhotosResource\Pages;

use App\Filament\Resources\PhotosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePhotos extends CreateRecord
{
    protected static string $resource = PhotosResource::class;
}
