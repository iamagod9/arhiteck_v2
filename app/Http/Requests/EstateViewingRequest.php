<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstateViewingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'time' => 'required',
            'phone' => 'required|min:14|max:18',
            'estate_id' => 'required|exists:estates,id',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'Укажите дату посещения.',
            'date.date' => 'Невалидная дата посещения.',
            'time.required' => 'Укажите время посещения.',
            'phone.required' => 'Укажите корректный номер телефона.',
            'phone.min' => 'Укажите корректный номер телефона.',
            'phone.max' => 'Укажите корректный номер телефона.',
            'estate_id.required' => 'Не указана недвижимость для посещения.',
            'estate_id.exists' => 'На выбранную недвижимость нельзя записаться.',
        ];
    }
}