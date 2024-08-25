<?php

namespace App\Http\Requests\BackEnd\Topics;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'title'   => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:30'],
            'image'   => ['image'],
            'author'  => ['required', 'string'],
            'cat_id'  => ['required', 'integer'],
            'permission' => ['required', 'integer'],
            'meta_keywords' => ['required', 'string'],
            'meta_desc' => ['required', 'string'],
        ];
    }
}
