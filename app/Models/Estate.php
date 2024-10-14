<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;


class Estate extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'description',
        'video_url',
        'preview_infrastructure_area_img',
        'avito_id',
        'date_begin',
        'date_end',
        'listing_fee',
        'ad_status',
        'contact_phone',
        'contact_method',
        'category',
        'price',
        'operation_type',
        'balcony_or_loggia',
        'market_type',
        'land_status',
        'land_area',
        'passenger_elevator',
        'freight_elevator',
        'courtyard',
        'new_development_id',
        'living_space',
        'renovation',
        'property_rights',
        'status',
        'nd_additionally',
        'square',
        'floor',
        'floors',
        'rooms',
        'built_year',
        'room_type',
        'house_type',
        'decoration',
        'kitchen_space',
        'apartments_number',
        'ceiling_height',
        'bathroom_type',
        'view_from_windows',
        'parking_type',
        'address',
        'lon',
        'lat',
        'lease_appliances',
        'repair_additionally',
        'in_house',
        'ss_additionally',
        'furniture',
        'land_additionally',
        'house_additionally',
        'electricity',
        'water_supply',
        'gas_supply',
        'heating',
        'heating_type',
        'sewerage',
        'infrastructure',
        'lease_multimedia',
        'walls_type',
        'user_id',
        'published',
        'estate_type_id',
        'published_at',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
        'land_additionally' => 'array',
        'lease_multimedia' => 'array',
        'infrastructure' => 'array',
        'courtyard' => 'array',
        'lease_appliances' => 'array',
        'parking_type' => 'array',
        'balcony_or_loggia' => 'array',
        'view_from_windows' => 'array',
        'room_type' => 'array',
        'nd_additionally' => 'array',
        'in_house' => 'array',
        'ss_additionally' => 'array',
        'furniture' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(EstateType::class, 'estate_type_id', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(EstateImage::class);
    }

    protected $hidden = [
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}