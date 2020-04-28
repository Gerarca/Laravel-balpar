<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudTarjeta extends Model
{
    protected $table = 'solicitud_tarjeta';

    protected $fillable = [
      'nombre', 'email', 'telefono', 'ci', 'nacimiento', 'documento', 'estado', 'apellido', 'celular', 'direccion', 'ciudad', 'trabajo', 'salario', 'tarjeta_marca', 'tarjeta_linea'
    ];

}
