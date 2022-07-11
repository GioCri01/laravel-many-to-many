<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|max:255|min:3',
            'content'=>'required|max:255|min:10'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Il titolo è obbligatorio',
            'title.max'=>'il titolo puo contenere al massimo :max caratteri',
            'title.min'=>'il titolo deve contenere almeno :min caratteri',
            'content.required'=>'Il contenuto è obbligatorio',
            'content.max'=>'il contenuto puo contenere al massimo :max caratteri',
            'content.min'=>'il contenuto deve contenere almeno :min caratteri'
        ];
    }
}
