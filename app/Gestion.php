<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    public $timestamps = false;
    protected $table = 'gestion';
    protected $fillable = [
        'id',
        'nombre',
        'inicial',
        'final',
        'motivo',
        'tiempo',
        'fecha',
        'observacion',
    ];
}
