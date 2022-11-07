<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentEditRequest extends FormRequest {
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
            'mensaje' => 'Mensaje del comentario',
            'idpost' => 'Post del comentario',
            'idusuario' => 'Usuario del comentario',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'mensaje' => 'required|string|min:1|max:200',
            'idpost' => 'required|string',
            'idusuario' => 'required|string',
        ];
    }
    
    public function messages() {
        $required = 'El campo :attribute es obligatorio';
        $string   = 'El campo :attribute debe ser string';
        $min      = 'El campo :attribute no puede tener menos de :min caracteres';
        $max      = 'El campo :attribute no puede tener más de :max caracteres';
        
        return [
            'mensaje.required' => $required,
            'mensaje.string'   => $string,
            'mensaje.min'      => $min,
            'mensaje.max'      => $max,
            'idpost.required' => $required,
            'idpost.string'   => $string,
            'idusuario.required' => $required,
            'idusuario.string'   => $string,
        ];
    }
}
