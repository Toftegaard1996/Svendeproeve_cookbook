<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'description' => 'string|nullable',
            'cook_time' => 'integer|nullable',
            'base_amount' => 'integer|required',
            'guide' => 'string|nullable',
            'country' => 'string|nullable',
            'notes' => 'string|nullable',
//            'ingredients' => 'array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Navnet på opskriften skal udfyldes',
            'name.string' => 'Navnet skal være ren tekst',
            'description.string' => 'Navnet skal være ren tekst',
            'cook_time.integer' => 'Arbejdstiden skal angives i hele minutter',
            'base_amount.integer' => 'Antal personer skal angives i hele tal',
            'guide.string' => 'Fremgangsmåden skal være ren tekst',
            'notes.string' => 'Noter skal være ren tekst',
        ];
    }
}
