<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SponsorshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shelter_id' => 'required|exists:shelters,id',
            'amount' => 'required|numeric|min:1000',
            'message' => 'nullable|string|max:500',
            'is_anonymous' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Please enter a donation amount.',
            'amount.min' => 'Minimum donation amount is Rp 1.000.',
            'shelter_id.required' => 'Shelter information is missing.',
            'shelter_id.exists' => 'The selected shelter does not exist.',
        ];
    }
}
