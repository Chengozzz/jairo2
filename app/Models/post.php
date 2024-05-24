<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo', 
        'descripcion',
        'imagen',
        'categoria_id',

    ];

    public function categoria() {
        return $this->belongsTo(categoria::class);
    }
    
    public function comentarios() {
        return $this->hasMany(comentario::class);
    }
}
