<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'cargo'
    ];
}
