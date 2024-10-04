<?php

namespace Database\Factories;

use App\Models\EstateType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estate>
 */
class EstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->address(),
            'date_begin' => fake()->dateTime(),
            'date_end' => fake()->dateTime(),
            'avito_id' => fake()->numberBetween(1000000, 9999999),
            'contact_phone' => fake()->phoneNumber(),
            'contact_method' => fake()->numberBetween(1, 3),
            'listing_fee' => fake()->numberBetween(2000000, 5000000),
            'ad_status' => fake()->numberBetween(1, 3),
            'category' => fake()->numberBetween(1, 3),
            'operation_type' => fake()->numberBetween(1, 3),
            'balcony_or_loggia' => fake()->numberBetween(1, 3),
            'market_type' => fake()->numberBetween(1, 3),
            'land_status' => fake()->numberBetween(1, 3),
            'land_area' => fake()->randomFloat(1, 20, 70),
            'passenger_elevator' => fake()->numberBetween(1, 3),
            'freight_elevator' => fake()->numberBetween(1, 3),
            'courtyard' => fake()->numberBetween(1, 3),
            'new_development_id' => fake()->numberBetween(1, 3),
            'living_space' => fake()->randomFloat(1, 5, 12),
            'renovation' => fake()->numberBetween(1, 3),
            'property_rights' => fake()->numberBetween(1, 3),
            'status' => fake()->numberBetween(1, 3),
            'nd_additionally' => fake()->numberBetween(1, 3),
            'video_url' => fake()->imageUrl(640, 480, 'animals', true),
            'description' => fake()->text(1000),
            'price' => fake()->numberBetween(2000000, 5000000),
            'square' => fake()->randomFloat(1, 20, 70),
            'floor' => fake()->numberBetween(1, 16),
            'floors' => fake()->numberBetween(5, 16),
            'rooms' => fake()->numberBetween(1, 5),
            'built_year' => fake()->year(),
            'room_type' => fake()->numberBetween(1, 3),
            'house_type' => "Панельные",
            'decoration' => "Косметический ремонт",
            'kitchen_space' => fake()->randomFloat(1, 5, 12),
            'bathroom_type' => "Раздельный",
            'view_from_windows' => "Во двор",
            'heating_type' => "Центральное отопление",
            'water_supply' => fake()->numberBetween(1, 3),
            'house_additionally' => fake()->numberBetween(1, 3),
            'gas_supply' => fake()->numberBetween(1, 3),
            'heating' => fake()->numberBetween(1, 3),
            'infrastructure' => fake()->numberBetween(1, 3),
            'walls_type' => fake()->numberBetween(1, 3),
            'lease_multimedia' => fake()->numberBetween(1, 3),
            'sewerage' => fake()->numberBetween(1, 3),
            'land_additionally' => fake()->numberBetween(1, 3),
            'electricity' => fake()->numberBetween(1, 3),
            'furniture' => fake()->numberBetween(1, 3),
            'ss_additionally' => fake()->numberBetween(1, 3),
            'in_house' => fake()->numberBetween(1, 3),
            'repair_additionally' => fake()->numberBetween(1, 3),
            'video_file_url' => fake()->imageUrl(640, 480, 'animals', true),
            'lease_appliances' => fake()->numberBetween(1, 3),
            'ceiling_height' => fake()->randomFloat(1, 2, 3),
            'apartment_number' => fake()->buildingNumber(),
            'parking_type' => "Собственная парковка",
            'estate_type_id' => fake()->numberBetween(1, 4)
        ];
    }
}
