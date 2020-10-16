<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    public $timestamps = false;
    protected $table = 'motivo_paro';
    protected $fillable = [
        'numero_op',
        'id',
        'tarea',
        'tiempo_descanso',
        'cantidad',
        'code',
        'motivo_descanso',
        'fecha',
        'hora',
        'inicial'
      

    ];
}
