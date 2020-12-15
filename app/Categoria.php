<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['categoria', 'meta_image', 'meta_description', 'meta_keywords'];

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

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

}
