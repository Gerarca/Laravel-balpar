<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';

    protected $fillable = [
      'titulo', 'logo', 'banner', 'web', 'orden', 'user_id', 'id', 'cod_origen', 'destacado', 'id_categoria'
    ];

    public function productos(){
      return $this->hasMany(Producto::class);
    }

    public function categoria(){
      return $this->belongsTo(Categoria::class);
    }

}
