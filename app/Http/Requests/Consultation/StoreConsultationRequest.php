<?php

namespace App\Http\Requests\Consultation;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
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
            'name_modal_feedback' => ['required_if:is_modal,1', 'string', 'max:255'],
            'phone_modal_feedback' => ['required_if:is_modal,1', 'string', 'max:255'],
            'name' => ['required_if:is_modal,0', 'string', 'max:255'],
            'phone' => ['required_if:is_modal,0', 'string', 'max:18'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'Поле "Ваше имя" обязательно',
    //         'name.string' => 'Поле "Ваше имя" должно быть строкой',
    //         'name.max' => 'У поля "Ваше имя" макс.длина 255 символом',
    //         'phone.required' => 'Поле "Ваш номер" обязательно',
    //         'phone.numeric' => 'Поле "Ваш номер" должно быть числом',
    //         'phone.digits' => 'У поля "Ваш номер" должно быть 11 символом',
    //     ];
    // }
}