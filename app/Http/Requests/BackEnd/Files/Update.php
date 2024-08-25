<?php

namespace App\Http\Requests\BackEnd\Files;

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
            'title' => ['required', 'max:30', 'string'],
            'course_id' => ['required', 'integer'],
            'file' => ['file', 'mimes:pdf'],
            'image' => ['image'],
            'description' => ['required', 'max:191' ,'string'],
            'permission'  => ['required', 'integer'],
            'author' => ['required', 'string'],
        ];
    }
}
