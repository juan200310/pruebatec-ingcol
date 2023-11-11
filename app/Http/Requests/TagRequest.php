<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio'
        ];
    }
}
