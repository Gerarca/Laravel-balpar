<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';

    protected $fillable = ['categoria_id', 'imagen', 'nombre'];

    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

}
