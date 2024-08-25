<?php

namespace App\Http\Requests\FrontEnd\Discussion;

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
            'title'  => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9_ ]+$/u',
                'unique:discussions,title,'.$this->discussion->id
            ],
            'body'   => ['required', 'string'],
            'image'  => ['image', 'max:10240', 'mimes:jpg,png,jpeg'],
            'cat_id' => ['required', 'exists:categories,id'],
        ];
    }

    public function attributes()
    {
        return [
            'cat_id' => 'category',
            'image'  => 'dicussion image',
        ];
    }
}
