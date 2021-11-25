<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
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
            'name'=> 'required|string',
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'password' => ['required', 'min:6'],
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'sms_number'=>'regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'whatsapp_number'=>'regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
        ];
        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ];
    }
}
