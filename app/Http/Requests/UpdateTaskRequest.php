<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'status' => 'required',
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id',
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
