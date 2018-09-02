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
            'email' => 'nullable|email|max:200|unique:users,profile_name,'.$this->user()->id,
            'starting_year' => 'nullable|numeric',
            'profile_name' => 'nullable|max:100|unique:users,profile_name,'.$this->user()->id,
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Adresa de E-Mail trebuie să fie validă.',
            'email.max' => 'Adresa de E-Mail nu poate depăși 200 de caractere.',
            'email.unique' => 'Adresa de E-Mail introdusă este deja folosită.',
            'starting_year.numeric' => 'Anul de începere al cursurilor trebuie să fie un număr.',
            'profile_name.max' => 'ID-ul din URL nu poate depăși 100 de caractere.',
            'profile_name.unique' => 'URL-ul pe care îl vrei este deja folosit.',
        ];
    }
}
