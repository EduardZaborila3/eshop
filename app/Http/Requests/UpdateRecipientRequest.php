<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipientRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'email' => ['nullable', 'email', 'max:254'],
            'phone' => ['required', 'min:7'],
            'street' => ['required'],
            'street_number' => ['required', 'numeric'],
            'city' => ['required'],
            'postal_code' => ['required', 'min:4'],
            'country' => ['required'],
            'notes' => ['nullable'],
            'deleted_at' => ['nullable', 'date'],
        ];
    }
}
