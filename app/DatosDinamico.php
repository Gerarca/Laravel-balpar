<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosDinamico extends Model
{
    protected $fillable = ['years', 'clientes', 'trabajos'];
}
