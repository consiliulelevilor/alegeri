<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMyProfilePictureRequest extends FormRequest
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
            'profile_picture' => 'dimensions:ratio=1/1',
        ];
    }

    public function messages()
    {
        return [
            'profile_picture.dimensions' => 'Poza încărcată trebuie să fie pătrată.',
        ];
    }
}
