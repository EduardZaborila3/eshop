<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20', 'min:9'],
            'street' => ['required', 'string', 'max:255', 'min:3'],
            'street_number' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:100', 'min:3'],
            'country' => ['required', 'string', 'max:100', 'min:3'],
            'postcode' => ['required', 'string', 'max:10', 'min:3'],
            'role' => ['required', 'in:admin,staff'],
            'is_active' => ['required'],
            'password' => ['required', 'string', Password::min(6), 'confirmed'],
        ];
    }
}
