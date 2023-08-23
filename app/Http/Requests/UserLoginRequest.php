<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|email' ,
            'password' => 'required|string' ,
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.requiredField' , ['field' => 'email']),
            'email.email' => __('validation.emailField' , ['field' => 'email']),

            'password.required' => __('validation.requiredField' , ['field' => 'password']),
            'password.string' => __('validation.stringField' , ['field' => 'password']),
        ];
    }
}
