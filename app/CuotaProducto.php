<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuotaProducto extends Model
{
    protected $table = 'productos_cuotas';

    protected $fillable = [
  		'cod_articulo', 'cantidad_cuotas', 'precio_cuotas',	'codigo_cuota',	'user_id'
    ];

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'cod_articulo');
    }

}
