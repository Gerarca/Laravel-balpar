<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamano extends Model
{
  protected $table = 'tamanos';

  protected $fillable = [
    'titulo', 'logo', 'banner', 'orden', 'user_id'
  ];

  public function productos()
   {
       return $this->belongsToMany(Producto::class, 'tamano_producto', 'tamano_id', 'cod_articulo');

   }
}
