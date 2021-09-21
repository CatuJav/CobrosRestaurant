<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable=['estado','observacion'];

    public function detalle()
    {
        return $this->hasMany('App\Models\Detalle','id_factura','id');
    }
}
