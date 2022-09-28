<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'firstName' => ['required', 'string', 'max:245'],
                'lastName' => ['required', 'string', 'max:245'],
                'address' => ['nullable'],
                'email' => ['required', 'email', 'max:245', 'unique:users'],
                'phoneNumber' => ['nullable'],
            ];
        } else {
            return [
                'firstName' => ['sometimes', 'required', 'string', 'max:245'],
                'lastName' => ['sometimes', 'required', 'string', 'max:245'],
                'address' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email', 'max:245', 'unique:users'],
                'phoneNumber' => ['sometimes', 'nullable'],
            ];
        }
    }
}
