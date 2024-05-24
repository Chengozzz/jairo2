<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion','parent_id','user_id', 'post_id'
            ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function parent(){
        return $this->belongTo(comentario::class, 'parent_id');
    }
    public function respuestas() {
        return $this->hasMany( comentario::class , 'parent_id' ) ; 
    }
}
