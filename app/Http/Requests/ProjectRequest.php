<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
                        'name' => 'required|min:2'
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'sometimes|required|min:2'
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
            'name' => 'Project name'
        ];
    }
}
