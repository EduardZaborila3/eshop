<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipientRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'unique:recipients,name'],
            'email' => ['nullable', 'email', 'max:254', 'unique:recipients,email'],
            'phone' => ['required', 'min:7', 'unique:recipients,phone'],
            'street' => ['required'],
            'street_number' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'postal_code' => ['required', 'min:4'],
            'notes' => ['nullable'],
        ];
    }
}
