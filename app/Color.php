<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
  protected $table = 'colores';

  protected $fillable = [
    'titulo', 'logo', 'banner', 'orden', 'user_id'
  ];
  public function productos()
   {
       return $this->belongsToMany(Producto::class, 'color_producto', 'color_id', 'cod_articulo');

   }
}
