<?php

namespace App\Filament\Clusters\Consultations\Resources\ConsultationResource\Pages;

use App\Filament\Clusters\Consultations\Resources\ConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConsultation extends CreateRecord
{
    protected static bool $canCreateAnother = false;
    protected static string $resource = ConsultationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
