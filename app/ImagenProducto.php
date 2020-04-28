<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    protected $table = 'imagenes_productos';

    protected $fillable = [
      'cod_articulo', 'descripcion',	'imagen',	'orden',	'codigo_imagen',	'user_id', 'updated_at'
    ];

    public function producto()
    {
        return $this->belongsToMany(Producto::class);
    }

}
