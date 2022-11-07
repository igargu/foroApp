<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    use HasFactory;
    
    protected $table = 'categoria';
    
    public $timestamps = false;
    
    protected $fillable = ['id', 'nombre'];
    
    public function posts() {
        return $this->hasMany('App\Models\Post', 'idcategoria');
    }
}