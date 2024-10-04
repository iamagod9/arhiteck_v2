<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = "feedbacks";

    protected $fillable = [
        'stars',
        'title',
        'comment',
        'phone',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
