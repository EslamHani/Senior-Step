<?php

namespace App\Http\Requests\BackEnd\Courses;

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
            'course_name' => [
                'required', 
                'max:191', 
                'min:5', 
                'regex:/^[a-zA-Z0-9_ ]+$/u',
                'unique:courses,course_name,'.$this->course
            ],
            'course_desc' => ['required', 'min:3'],
            'cat_id' => ['required'],
            'teacher' => ['required', 'string'],
            'image'  => ['nullable'],
            'permission' => ['required', 'integer'],
            'meta_keywords' => ['required', 'string'],
            'meta_desc' => ['required', 'string'],
        ];
    }
}
