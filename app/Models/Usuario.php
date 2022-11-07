<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    use HasFactory;
    
    protected $table = 'usuario';
    
    public $timestamps = true;
    
    protected $fillable = ['id', 'nombre', 'correo', 'fechaNacimiento'];
    
    public function posts() {
        return $this->hasMany('App\Models\Post', 'idusuario');
    }
    
    public function comments() {
        return $this->hasMany('App\Models\Comment', 'idusuario');
    }
}
