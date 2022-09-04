<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
        return [
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255|unique:clients',
            'client_phone' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_city' => 'required',
            'company_zip' => 'required|integer',
            'company_vat' => 'required|integer',
        ];
    }
}
