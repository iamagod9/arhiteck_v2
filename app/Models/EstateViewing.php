<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\EstateViewingStatus;

class EstateViewing extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'phone',
        'estate_id'
    ];

    protected $casts = [
        'status' => EstateViewingStatus::class,
    ];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}