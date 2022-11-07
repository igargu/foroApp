<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;
    
    protected $table = 'post';
    
    public $timestamps = true;
    
    protected $fillable = ['id', 'titulo', 'mensaje', 'idusuario', 'idcategoria'];
    
    public function usuario() {
        return $this->belongsTo('App\Models\Usuario', 'idusuario');
    }
    
    public function categoria() {
        return $this->belongsTo('App\Models\Categoria', 'idcategoria');
    }
    
    public function comments() {
        return $this->hasMany('App\Models\Comment', 'idpost');
    }
}
