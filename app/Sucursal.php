<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';

    protected $fillable = [
      'titulo', 'imagen', 'direccion', 'telefono', 'mail', 'ubicacion', 'orden', 'user_id', 'iframe'
    ];

}
