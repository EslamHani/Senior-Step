<?php

namespace App\Http\Requests\BackEnd\Videos;

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
            'video_name' => ['required', 'min:10', 'regex:/^[a-zA-Z0-9_ ]+$/u', 'max:191'],
            'video_desc' => ['required', 'min:10'],
            'youtube' => ['required', 'url', 'min:10'],
            'course_id'  => ['required', 'integer'],
            'permission' => ['required', 'integer'],
            'time' => ['required'],
            'transcript' => ['required'],
            'open_comments'   => ['integer'],
        ];
    }
}
