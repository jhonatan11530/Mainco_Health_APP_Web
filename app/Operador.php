<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    public $timestamps = false;
    protected $table = 'operador';
    protected $fillable = [
        'id',
        'nombre',
        'numero_op',
        'tarea',
        'inicial',
        'hora_inicial',
        'final',
        'hora_final',
        'no_conforme'
      

    ];
}
