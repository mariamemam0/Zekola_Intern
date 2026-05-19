<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // check if request is update (PUT/PATCH) or store (POST)
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'name'     => 'sometimes|required|string',
                'email'    => 'sometimes|required|email',
                'password' => 'sometimes|required|min:8',
            ];
        }

        // store rules
        return [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];
    }
}
