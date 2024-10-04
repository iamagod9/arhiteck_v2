<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum EstateViewingStatus: string implements HasLabel, HasIcon, HasColor
{
  case New = 'Новая';
  case Canceled = 'Отменено';
  case Completed = 'Завершено';

  public function getColor(): string|array|null
  {
    return match ($this) {
      self::New => 'success',
      self::Canceled => 'danger',
      self::Completed => 'warning',
    };
  }

  public function getIcon(): ?string
  {
    return match ($this) {
      self::New => 'heroicon-o-sparkles',
      self::Canceled => 'heroicon-o-x-mark',
      self::Completed => 'heroicon-o-check',
    };
  }

  public function getLabel(): string
  {
    return match ($this) {
      self::New => 'Новая',
      self::Canceled => 'Отменено',
      self::Completed => 'Завершено',
    };
  }
}