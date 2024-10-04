<?php

namespace App\Filament\Resources\EstateResource\Pages;

use App\Filament\Resources\EstateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEstate extends CreateRecord
{
    protected static bool $canCreateAnother = false;
    protected static string $resource = EstateResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
