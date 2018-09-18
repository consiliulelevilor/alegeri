<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMyCoverPictureRequest extends FormRequest
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
            'profile_picture' => 'image|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'profile_picture.image' => 'Poza de profil trebuie să fie imagine.',
            'profile_picture.max' => 'Poza de copertă nu poate avea mai mult de 10 MB.',
        ];
    }
}
