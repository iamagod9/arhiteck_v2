<?php

namespace App\Filament\Clusters\Consultations\Resources\EstateViewingResource\Pages;

use App\Filament\Clusters\Consultations\Resources\EstateViewingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstateViewing extends EditRecord
{
    protected static string $resource = EstateViewingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
