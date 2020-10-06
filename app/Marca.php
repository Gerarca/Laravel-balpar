<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';

    protected $fillable = ['imagen', 'nombre', 'meta_description', 'meta_keywords'];

    public function productos(){
        return $this->hasMany(Producto::class);
    }

}
