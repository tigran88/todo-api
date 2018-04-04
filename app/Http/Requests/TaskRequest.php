<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|min:2',
                    'project_id' => 'required|exists:projects,id',
                    'user_id' => 'exists:users,id'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'sometimes|required|min:2',
                    'project_id' => 'sometimes|required|exists:projects,id',
                    'user_id' => 'exists:users,id'
                ];
            }
        }
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Task name',
            'project_id' => 'Project ID',
            'user_id' => 'User ID'
        ];
    }
}
