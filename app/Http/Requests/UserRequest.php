<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'name' => 'required|min:2',
                        'email' => 'required|email|unique:users,email',
                        'password' => 'required|min:6'
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    // TODO:: add rule 'email' => 'sometimes|required|unique:users,email,' . $userId,
                    return [
                        'name' => 'sometimes|required|min:2',
                        'email' => 'sometimes|required|unique:users,email,6',
                        'password' => 'sometimes|required'
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
            'name' => 'User name',
            'email' => 'User email',
            'password' => 'User password'
        ];
    }
}
