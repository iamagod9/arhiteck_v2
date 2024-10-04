<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ConsultationStatus;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'status' => ConsultationStatus::class,
    ];
}
