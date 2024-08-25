<?php

namespace App\Http\Requests\BackEnd\Users;

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
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:30'],
            'image'  => ['nullable', 'max:10240'],
            'address'    => ['nullable','string', 'min:10', 'max:50'],
            'bio' => ['nullable','string', 'min:5', 'max:50'],
            'country' => ['nullable','string'],
            'permission' => ['required', 'integer'],
            'verified'  => ['required', 'integer'],
            'level' => ['integer'],
        ];
    }
}
