<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdoptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only authenticated adopters can submit adoption requests
        return $this->user() && $this->user()->isAdopter();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pet_id' => 'required|exists:pets,id',
            'reason' => 'required|string|min:50|max:1000',
            'experience' => 'required|string|max:500',
            'housing_type' => 'required|in:house,apartment,farm,other',
            'has_other_pets' => 'required|boolean',
            'other_pets_details' => 'nullable|required_if:has_other_pets,1|string|max:500',
            'has_children' => 'required|boolean',
            'children_ages' => 'nullable|required_if:has_children,1|string|max:200',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'references' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'reason.min' => 'Please provide at least 50 characters explaining why you want to adopt this pet.',
            'other_pets_details.required_if' => 'Please provide details about your other pets.',
            'children_ages.required_if' => 'Please provide the ages of children in your household.',
        ];
    }
}
