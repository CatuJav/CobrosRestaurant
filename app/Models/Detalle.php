<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $fillable=['id_producto','cantidad','id_factura'];

    public function detalle()
    {
        return $this->belongsTo('App\Models\Factura<','id_factura','id');
    }
    public function producto()
    {
        return $this->belongsTo('App\Models\Producto','id_producto','id');
    }
}
