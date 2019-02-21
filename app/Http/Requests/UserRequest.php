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
        $rules = [
            //'role_id' => 'required',
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed'
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'email is required',
            'password.required'  => 'password is required',
            'password' => 'password not valid'
        ];
    }
    
}
