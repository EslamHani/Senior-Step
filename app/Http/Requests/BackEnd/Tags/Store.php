<?php

namespace App\Http\Requests\BackEnd\Tags;

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
            'tag_name' => ['required', 'max:191', 'regex:/^[a-zA-Z0-9_ ]+$/u', 'unique:tags'],
            'permission' => ['required', 'integer'],
            'meta_keywords' => ['required', 'string'],
            'meta_desc' => ['required', 'string'],
        ];
    }
}
