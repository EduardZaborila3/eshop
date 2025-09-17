<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserIndexRequest extends FormRequest
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
            'order_by' => ['nullable', 'in:email,created_at'],
            'direction' => ['nullable', 'in:asc,desc'],
            'role' => ['nullable', 'in:admin,staff'],
            'is_active' => ['nullable', 'in:1,0'],
            'per_page' => ['numeric', 'min:1', 'max:100']
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            redirect()->route('users.index')->with('error', 'You cannot do that.')
        );
    }
}
