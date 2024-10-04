<?php

namespace App\Filament\Clusters\Consultations\Resources\EstateViewingResource\Pages;

use App\Filament\Clusters\Consultations\Resources\EstateViewingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEstateViewing extends CreateRecord
{
    protected static string $resource = EstateViewingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
