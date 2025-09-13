<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
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
        $userId = request('user');
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'phone' => ['required', 'string', 'max:20', 'min:9'],
            'street' => ['required', 'string', 'max:255', 'min:3'],
            'street_number' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:100', 'min:3'],
            'country' => ['required', 'string', 'max:100', 'min:3'],
            'postcode' => ['required', 'string', 'max:10', 'min:3'],
            'role' => ['required', 'in:admin,staff'],
            'is_active' => ['required']
        ];

    }
}
