<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            'feedback_phone' => ['required', 'string', 'min:14', 'max:18', 'unique:feedbacks,phone'],
            'feedback_name' => ['required', 'string', 'max:100'],
            'comment' => ['required', 'string', 'max:1000'],
            'stars' => ['integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'feedback_name.required' => 'Укажите, пожалуйста, корректное имя.',
            'feedback_name.string' => 'Имя должно быть строкой.',
            'feedback_name.max' => 'Имя слишком длинное.',
            'feedback_phone.required' => 'Укажите, пожалуйста, корректный номер телефона.',
            'feedback_phone.string' => 'Имя должен быть строкой.',
            'feedback_phone.min' => 'Некорректно указан номер.',
            'feedback_phone.max' => 'Некорректно указан номер.',
            'feedback_phone.unique' => 'С данного номера уже был оставлен отзыв.',
            'comment.required' => 'Напишите, пожалуйста, комментарий.',
            'comment.string' => 'Комментарий должен быть строкой.',
            'comment.max' => 'Комментарий слишком длинный, максимальная длина - 1000 символов.',
            'stars.min' => 'Укажите, пожалуйста, оценку.',
        ];
    }
}