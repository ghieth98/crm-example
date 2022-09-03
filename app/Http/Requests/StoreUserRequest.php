<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:245'],
            'last_name' => ['required', 'string', 'max:245'],
            'address' => ['nullable'],
            'email' => ['required', 'email','max:245', 'unique:users'],
            'phone_number' => ['nullable'],
        ];
    }
}
