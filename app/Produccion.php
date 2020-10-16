<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    public $timestamps = false;
    protected $table = 'produccion';
    protected $fillable = [
        'id',
        'numero_op',
        'cod_producto',
        'descripcion',
        'cantidad',
        'programadas',
        'autorizado'
    ];
}
