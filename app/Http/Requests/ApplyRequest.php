<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
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
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
            'question4' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'question1.required' => 'Pentru a candida, trebuie să răspunzi la toate întrebările.',
            'question2.required' => 'Pentru a candida, trebuie să răspunzi la toate întrebările.',
            'question3.required' => 'Pentru a candida, trebuie să răspunzi la toate întrebările.',
            'question4.required' => 'Pentru a candida, trebuie să răspunzi la toate întrebările.',
        ];
    }
}
