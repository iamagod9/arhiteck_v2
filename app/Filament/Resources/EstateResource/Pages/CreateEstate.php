<?php

namespace App\Filament\Resources\EstateResource\Pages;

use App\Filament\Resources\EstateResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEstate extends CreateRecord
{
    protected static bool $canCreateAnother = false;
    protected static string $resource = EstateResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $imageUrl = EstateResource::savePreviewMap($data['lat'], $data['lon']);
        if ($imageUrl) {
            $data['preview_infrastructure_area_img'] = $imageUrl;
        }
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
