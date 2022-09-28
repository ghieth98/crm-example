<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
        if ($method == 'PUT'){
            return [
                'clientName' => 'required|string|max:255',
                'clientEmail' => 'required|email|max:255|unique:clients',
                'clientPhone' => 'required',
                'companyName' => 'required',
                'companyAddress' => 'required',
                'companyCity' => 'required',
                'companyZip' => 'required|integer',
                'companyVat' => 'required|integer',
            ];
        }else{
            return [
                'clientName' => 'sometimes|required|string|max:255',
                'clientEmail' => 'sometimes|required|email|max:255|unique:clients',
                'clientPhone' => 'sometimes|required',
                'companyName' => 'sometimes|required',
                'companyAddress' => 'sometimes|required',
                'companyCity' => 'sometimes|required',
                'companyZip' => 'sometimes|required|integer',
                'companyVat' => 'sometimes|required|integer',
            ];
        }

    }
}
