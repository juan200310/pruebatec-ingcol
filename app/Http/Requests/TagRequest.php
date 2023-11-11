<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase TagRequest que contiene las validaciones de la clase Tag
 *
 * @author  Juan Lopez
 */
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
