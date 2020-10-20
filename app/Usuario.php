<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model 
{

    public $timestamps = false;
    protected $table = 'usuarios';
    protected $fillable = [
        'nomusuario',
        'apeusuario',
        'password',
        'cedula',
        'rol',
        'cargo'
    ];

}
