<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ConsultationStatus: string implements HasLabel, HasIcon, HasColor
{
  case New = 'Новая';
  case InProcess = 'В работе';
  case Closed = 'Закрыта';

  public function getColor(): string|array|null
  {
    return match ($this) {
      self::New => 'success',
      self::InProcess => 'warning',
      self::Closed => 'danger',
    };
  }

  public function getIcon(): ?string
  {
    return match ($this) {
      self::New => 'heroicon-o-sparkles',
      self::InProcess => 'heroicon-o-arrow-path',
      self::Closed => 'heroicon-o-x-mark',
    };
  }

  public function getLabel(): string
  {
    return match ($this) {
      self::New => 'Новая',
      self::InProcess => 'В работе',
      self::Closed => 'Закрыта',
    };
  }
}