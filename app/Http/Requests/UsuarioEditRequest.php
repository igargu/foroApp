<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEditRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function attributes() {
        return [
            'nombre' => 'Nombre del usuario',
            'correo' => 'Correo del usuario',
            'fechaNacimiento' => 'Fecha de nacimiento del usuario',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'nombre' => 'required|string|min:1|max:30',
            'correo' => 'required|string|max:70|unique:usuario,correo'.$this->usuario->id,
            'fechaNacimiento' => 'required|date',
        ];
    }
    
    public function messages() {
        $required = 'El campo :attribute es obligatorio';
        $string   = 'El campo :attribute debe ser string';
        $date     = 'El campo :attribute tiene que ser una fecha en formato dd/mm/aaaa';
        $min      = 'El campo :attribute no puede tener menos de :min caracteres';
        $max      = 'El campo :attribute no puede tener más de :max caracteres';
        
        return [
            'nombre.required' => $required,
            'nombre.string'   => $string,
            'nombre.min'      => $min,
            'nombre.max'      => $max,
            'correo.required' => $required,
            'correo.max'      => $max,
            'fechaNacimiento.required' => $required,
            'fechaNacimiento.date'   => $date,
        ];
    }
}
