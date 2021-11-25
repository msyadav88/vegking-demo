<?php

namespace App\Http\Requests\Frontend\User;
use Illuminate\Validation\Rule;
use App\Helpers\Auth\SocialiteHelper;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateProfileRequest.
 */
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
            'avatar_location' => ['sometimes', 'image', 'max:191'],
        ];
    }
}
