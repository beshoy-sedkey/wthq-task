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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'sometimes|unique:users,email,except,id',
            'password' => 'sometimes',
            'name' => 'sometimes',
            'type' => 'sometimes|in:gold,normal,silver',
            'username' => 'sometimes'
        ];
    }
}
