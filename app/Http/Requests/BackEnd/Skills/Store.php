<?php

namespace App\Http\Requests\BackEnd\Skills;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'skill_name' => ['required', 'max:191','regex:/^[a-zA-Z0-9_ ]+$/u', 'unique:skills'],
            'permission' => ['required', 'integer'],
            'meta_desc'  => ['required', 'string'],
            'meta_keywords'  => ['required', 'string'],
        ];

    }
}
