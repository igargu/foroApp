<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostEditRequest extends FormRequest {
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
            'titulo' => 'Titulo del post',
            'mensaje' => 'Mensaje del post',
            'idusuario' => 'Usuario del post',
            'idcategoria' => 'Categoría del post',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'titulo' => 'required|string|min:1|max:100',
            'mensaje' => 'required|string|min:1|max:200',
            'idusuario' => 'required|string',
            'idcategoria' => 'required|string',
        ];
    }
    
    public function messages() {
        $required = 'El campo :attribute es obligatorio';
        $string   = 'El campo :attribute debe ser string';
        $min      = 'El campo :attribute no puede tener menos de :min caracteres';
        $max      = 'El campo :attribute no puede tener más de :max caracteres';
        
        return [
            'titulo.required' => $required,
            'titulo.string'   => $string,
            'titulo.min'      => $min,
            'titulo.max'      => $max,
            'mensaje.required' => $required,
            'mensaje.string'   => $string,
            'mensaje.min'      => $min,
            'mensaje.max'      => $max,
            'idusuario.required' => $required,
            'idusuario.string'   => $string,
            'idcategoria.required' => $required,
            'idcategoria.string'   => $string,
        ];
    }
}
