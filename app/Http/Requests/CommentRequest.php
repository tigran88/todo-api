<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
                    'text' => 'required|min:3',
                    'task_id' => 'required|exists:tasks,id',
                    'user_id' => 'required|exists:users,id'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'text' => 'sometimes|required|min:3',
                    'task_id' => 'sometimes|required|exists:tasks,id',
                    'user_id' => 'sometimes|required|exists:users,id'
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
            'text' => 'Comment text',
            'task_id' => 'Task ID',
            'user_id' => 'User ID'
        ];
    }
}
