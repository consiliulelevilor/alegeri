<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeRequest extends FormRequest
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
            'starting_year' => 'nullable|numeric',
            'profile_name' => 'unique:users,profile_name,'.$this->user()->id,
        ];
    }

    public function messages()
    {
        return [
            'starting_year.numeric' => 'Anul de începere al cursurilor trebuie să fie un număr.',
            'profile_name.unique' => 'URL-ul pe care îl vrei este deja folosit.',
        ];
    }
}
