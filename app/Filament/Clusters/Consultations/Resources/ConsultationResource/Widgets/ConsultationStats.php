<?php

namespace App\Filament\Clusters\Consultations\Resources\ConsultationResource\Widgets;

use App\Filament\Clusters\Consultations\Resources\ConsultationResource;
use App\Filament\Clusters\Consultations\Resources\ConsultationResource\Pages\ListConsultations;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConsultationStats extends BaseWidget
{
  use InteractsWithPageTable;

  protected static ?string $pollingInterval = 'null';

  protected function getTablePage(): string
  {
    return ListConsultations::class;
  }

  protected function getHeaderWidgets(): array
  {
    return ConsultationResource::getWidgets();
  }

  protected function getStats(): array
  {
    return [
      Stat::make('Всего заявок', $this->getPageTableQuery()->count()),
      Stat::make('Новых', $this->getPageTableQuery()->where('status', 'Новая')->count()),
      Stat::make('В работе', $this->getPageTableQuery()->where('status', 'В работе')->count()),
      Stat::make('Закрытых', $this->getPageTableQuery()->where('status', 'Закрыта')->count()),
    ];
  }
}