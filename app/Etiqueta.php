<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
  protected $table = 'etiquetas';

  protected $fillable = [
    'titulo', 'logo', 'banner', 'orden', 'user_id'
  ];
  public function productos()
   {
       // return $this->belongsToMany('App\Producto', 'etiqueta_producto', 'etiqueta_id', 'cod_articulo');
       return $this->belongsToMany(Producto::class, 'etiqueta_producto', 'etiqueta_id', 'cod_articulo');

   }
}
