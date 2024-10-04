<?php

namespace App\Filament\Clusters\Consultations\Resources\EstateViewingResource\Pages;

use App\Filament\Clusters\Consultations\Resources\EstateViewingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListEstateViewings extends ListRecords
{

    use ExposesTableToWidgets;
    protected static string $resource = EstateViewingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return EstateViewingResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Все'),
            'Новая' => Tab::make()->query(fn($query) => $query->where('status', 'Новая')),
            'Завершено' => Tab::make()->query(fn($query) => $query->where('status', 'Завершено')),
            'Отменено' => Tab::make()->query(fn($query) => $query->where('status', 'Отменено')),
        ];
    }
}
