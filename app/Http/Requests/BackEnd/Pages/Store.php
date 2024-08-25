<?php

namespace App\Http\Requests\BackEnd\Pages;

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
            'page_name' => ['required', 'max:191', 'min:3', 'unique:pages'],
            'page_desc' => ['required', 'min:20'],
            'meta_keywords' => ['required'],
            'meta_desc'  => ['required'],
            'permission' => ['required', 'integer'],
        ];
    }
}
