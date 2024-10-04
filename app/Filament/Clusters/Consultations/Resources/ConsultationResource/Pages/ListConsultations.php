<?php

namespace App\Filament\Clusters\Consultations\Resources\ConsultationResource\Pages;

use App\Filament\Clusters\Consultations\Resources\ConsultationResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListConsultations extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = ConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return ConsultationResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Все'),
            'Новые' => Tab::make()->query(fn($query) => $query->where('status', 'Новая')),
            'В работе' => Tab::make()->query(fn($query) => $query->where('status', 'В работе')),
            'Закрытые' => Tab::make()->query(fn($query) => $query->where('status', 'Закрыта')),
        ];
    }
}
