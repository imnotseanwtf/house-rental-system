<?php

namespace App\Http\Requests\House;

use Illuminate\Foundation\Http\FormRequest;

class StoreHouseRequest extends FormRequest
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
            'house_number' => ['required', 'integer'],
            'house_type_id' => ['required', 'integer', 'exists:house_types,id'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric']
        ];
    }
}
