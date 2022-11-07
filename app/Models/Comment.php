<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;
    
    protected $table = 'comment';
    
    public $timestamps = true;
    
    protected $fillable = ['id', 'mensaje', 'idpost', 'idusuario'];
    
    public function post() {
        return $this->belongsTo('App\Models\Post', 'idpost');
    }
    
    public function usuario() {
        return $this->belongsTo('App\Models\Usuario', 'idusuario');
    }
}
