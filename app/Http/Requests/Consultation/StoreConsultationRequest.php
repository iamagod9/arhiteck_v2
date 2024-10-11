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
            'name_estate_consultation' => ['required_if:is_estate,1', 'string', 'max:255'],
            'phone_estate_consultation' => ['required_if:is_estate,1', 'string', 'min:14', 'max:18'],
            'name_modal_feedback' => ['required_if:is_modal,1', 'string', 'max:255'],
            'phone_modal_feedback' => ['required_if:is_modal,1', 'string', 'min:14', 'max:18'],
            'name' => ['required_if:is_modal,0', 'string', 'max:255'],
            'phone' => ['required_if:is_modal,0', 'string', 'min:14', 'max:18'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required_if' => 'Укажите, пожалуйста, корректное имя.',
            'name.string' => 'Имя должно быть строкой.',
            'name.max' => 'Вы указали слишком длинное имя.',
            'name_modal_feedback.required_if' => 'Укажите, пожалуйста, корректное имя.',
            'name_modal_feedback.string' => 'Имя должно быть строкой.',
            'name_modal_feedback.max' => 'Вы указали слишком длинное имя.',
            'name_estate_consultation.required_if' => 'Укажите, пожалуйста, корректное имя.',
            'name_estate_consultation.string' => 'Имя должно быть строкой.',
            'name_estate_consultation.max' => 'Вы указали слишком длинное имя.',
            'phone.required_if' => 'Укажите, пожалуйста, корректный номер телефона.',
            'phone.string' => 'Номер должен быть строкой.',
            'phone.min' => 'Неверный формат номера.',
            'phone.max' => 'Неверный формат номера.',
            'phone_modal_feedback.required_if' => 'Укажите, пожалуйста, корректный номер телефона.',
            'phone_modal_feedback.string' => 'Номер должен быть строкой.',
            'phone_modal_feedback.min' => 'Неверный формат номера.',
            'phone_modal_feedback.max' => 'Неверный формат номера.',
            'phone_estate_consultation.required_if' => 'Укажите, пожалуйста, корректный номер телефона.',
            'phone_estate_consultation.string' => 'Номер должен быть строкой.',
            'phone_estate_consultation.min' => 'Неверный формат номера.',
            'phone_estate_consultation.max' => 'Неверный формат номера.',
        ];
    }
}