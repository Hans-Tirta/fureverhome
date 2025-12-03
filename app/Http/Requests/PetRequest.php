<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow if user is shelter or admin
        return $this->user() && ($this->user()->isShelter() || $this->user()->isAdmin());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'breed' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'age_years' => 'required|integer|min:0|max:30',
            'age_months' => 'required|integer|min:0|max:11',
            'size' => 'required|in:small,medium,large',
            'gender' => 'required|in:male,female',
            'description' => 'required|string|min:50',
            'medical_history' => 'nullable|string',
            'vaccination_status' => 'nullable|string|max:255',
            'is_neutered' => 'boolean',
            'is_house_trained' => 'boolean',
            'good_with_kids' => 'boolean',
            'good_with_pets' => 'boolean',
            'adoption_fee' => 'nullable|numeric|min:0',
        ];

        // For create (POST), images are required
        if ($this->isMethod('POST')) {
            $rules['images'] = 'required|array|min:1|max:5';
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,webp|max:2048';
        }
        // For update (PUT/PATCH), images are optional
        else {
            $rules['images'] = 'nullable|array|max:5';
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Pet name is required',
            'category_id.required' => 'Please select a category',
            'category_id.exists' => 'Selected category does not exist',
            'description.min' => 'Description must be at least 50 characters',
            'images.required' => 'At least one image is required',
            'images.max' => 'Maximum 5 images allowed',
            'images.*.image' => 'File must be an image',
            'images.*.max' => 'Image size cannot exceed 2MB',
        ];
    }
}
