<?php

namespace App\Http\Requests\Estate;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'description' => ['required', 'longtext', 'max:7500'],
            // 'images' => ['required', 'string'],
            // 'video_url' => ['nullable', 'url'],
            // 'avito_id' => ['required', 'string', 'max:255'],
            // 'date_begin' => ['required', 'datetime'],
            // 'date_end' => ['required', 'datetime'],
            // 'listing_fee' => ['required', 'numeric'],
            // 'ad_status' => ['required', 'numeric'],
            // 'manager_name' => ['required', 'string', 'max:100'],
            // 'contact_phone' => ['required', 'numeric', 'digits:11'],
            // 'contact_method' => ['required', 'numeric'],
            // 'category' => ['required', 'numeric'],
            // 'price' => ['required', 'numeric'],
            // 'operation_type' => ['required', 'numeric'],
            // 'balcony_or_loggia' => ['required', 'numeric'],
            // 'market_type' => ['required', 'numeric'],
            // 'land_status' => ['required', 'numeric'],
            // 'land_area' => ['required', 'numeric'],
            // 'passenger_elevator' => ['required', 'numeric'],
            // 'freight_elevator' => ['required', 'numeric'],
            // 'courtyard' => ['required', 'numeric'],
            // 'new_development_id' => ['required', 'numeric'],
            // 'living_space' => ['required', 'numeric'],
            // 'renovation' => ['required', 'numeric'],
            // 'property_rights' => ['required', 'numeric'],
            // 'status' => ['required', 'numeric'],
            // 'nd_additionally' => ['required', 'numeric'],
            // 'square' => ['required', 'numeric'],
            // 'floor' => ['required', 'numeric'],
            // 'floors' => ['required', 'numeric'],
            // 'rooms' => ['required', 'numeric'],
            // 'built_year' => ['required', 'numeric'],
            // 'room_type' => ['required', 'numeric'],
            // 'house_type' => ['required', 'string'],
            // 'decoration' => ['required', 'string'],
            // 'kitchen_space' => ['required', 'numeric'],
            // 'apartments_number' => ['required', 'numeric'],
            // 'ceiling_height' => ['required', 'numeric'],
            // 'bathroom_type' => ['required', 'numeric'],
            // 'view_from_windows' => ['required', 'numeric'],
            // 'parking_type' => ['required', 'numeric'],
            // 'address' => ['required', 'string', 'max:255'],
            // 'lease_appliances' => ['required', 'string'],
            // 'repair_additionally' => ['required', 'string'],
            // 'in_house' => ['required', 'string'],
            // 'ss_additionally' => ['required', 'string'],
            // 'furniture' => ['required', 'string'],
            // 'land_additionally' => ['required', 'string'],
            // 'house_additionally' => ['required', 'string'],
            // 'electricity' => ['required', 'string'],
            // 'water_supply' => ['required', 'string'],
            // 'gas_supply' => ['required', 'string'],
            // 'heating' => ['required', 'string'],
            // 'heating_type' => ['required', 'string'],
            // 'sewerage' => ['required', 'string'],
            // 'infrastructure' => ['required', 'string'],
            // 'lease_multimedia' => ['required', 'string'],
            // 'walls_type' => ['required', 'string'],
            // 'user_id' => ['required', 'numeric'],
            // 'published' => ['required', 'numeric'],
            // 'estate_type_id' => ['required', 'numeric'],
            // 'published_at' => ['required', 'date'],
        ];
    }
}
