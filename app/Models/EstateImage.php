<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstateImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'sort',
        'estate_id'
    ];

    protected $casts = [
        'url' => 'json',
    ];

    public function estate(): BelongsTo
    {
        return $this->belongsTo(Estate::class);
    }
}
