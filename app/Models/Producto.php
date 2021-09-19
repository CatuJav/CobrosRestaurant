<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable=['nombre','precio','id_categoria'];
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria','id_categoria','id');
    }
}
