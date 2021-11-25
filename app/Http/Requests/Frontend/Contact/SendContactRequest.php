<?php

namespace App\Http\Requests\Frontend\Contact;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SendContactRequest.
 */
class SendContactRequest extends FormRequest
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
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
            //'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ];
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
