<?php

namespace App\Filament\Clusters\Consultations\Resources\EstateViewingResource\Widgets;

use App\Filament\Clusters\Consultations\Resources\EstateViewingResource;
use App\Filament\Clusters\Consultations\Resources\EstateViewingResource\Pages\ListEstateViewings;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class EstateViewingStats extends BaseWidget
{
  use InteractsWithPageTable;

  protected static ?string $pollingInterval = 'null';

  protected function getTablePage(): string
  {
    return ListEstateViewings::class;
  }

  protected function getHeaderWidgets(): array
  {
    return EstateViewingResource::getWidgets();
  }

  protected function getStats(): array
  {
    $sevenDaysAgo = Carbon::now()->subDays(7);

    return [
      Stat::make('Запланировано визитов', $this->getPageTableQuery()->where('status', 'Новая')->count()),
      Stat::make('Визитов сегодня', $this->getPageTableQuery()->where('status', 'Новая')->where('date', now()->format('Y-m-d'))->count()),
      Stat::make('Визитов на этой неделе', $this->getPageTableQuery()->where('status', 'Новая')->where('date', '>=', $sevenDaysAgo)->count()),
    ];
  }
}