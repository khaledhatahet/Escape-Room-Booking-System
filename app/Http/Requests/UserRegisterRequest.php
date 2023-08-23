<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|string' ,
            'email' => 'required|email|unique:users,email' ,
            'password' => 'required|string' ,
            'repassword' => 'required|string|same:password' ,
            'date_of_birth' => 'required|date' ,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.requiredField' , ['field' => 'name']),
            'name.string' => __('validation.stringField' , ['field' => 'name']),

            'email.required' => __('validation.requiredField' , ['field' => 'email']),
            'email.email' => __('validation.emailField' , ['field' => 'email']),
            'email.unique' => __('validation.uniqueEmail'),

            'password.required' => __('validation.requiredField' , ['field' => 'password']),
            'password.string' => __('validation.stringField' , ['field' => 'password']),

            'repassword.required' => __('validation.requiredField' , ['field' => 'repassword']),
            'repassword.string' => __('validation.stringField' , ['field' => 'repassword']),
            'repassword.same' => __('validation.passwordsMustBeSame'),

            'date_of_birth.required' => __('validation.requiredField' , ['field' => 'date of birth']),
            'date_of_birth.date' => __('validation.dateField', ['field' => 'date of birth']),

        ];
    }
}
