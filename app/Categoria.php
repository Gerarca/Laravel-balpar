<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['categoria'];

    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function marcas(){
        return $this->hasMany(Marca::class);
    }

    public function usos(){
        return $this->hasMany(Uso::class);
    }

    public function rubros(){
        return $this->hasMany(Rubro::class);
    }

}
