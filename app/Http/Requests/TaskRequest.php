<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase TaskRequest que contiene las validaciones de la clase Task
 *
 * @author  Juan Lopez
 */
class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'fecha_vencimiento' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'descripcion.required' => 'La descripción es obligatoria',
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria',
            'fecha_vencimiento.date' => 'El campo fecha de vencimiento debe ser una fecha válida'
        ];
    }
}
