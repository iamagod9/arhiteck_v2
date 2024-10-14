<?php

namespace App\Filament\Resources\EstateResource\Pages;

use App\Filament\Resources\EstateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditEstate extends EditRecord
{
    protected static string $resource = EstateResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($record->lon != $data['lon'] && $record->lat != $data['lat']) {
            $imageUrl = EstateResource::savePreviewMap($data['lat'], $data['lon']);
            if ($imageUrl) {
                $data['preview_infrastructure_area_img'] = $imageUrl;
                $record->update($data);
            }
        }
        return $record;
    }

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
