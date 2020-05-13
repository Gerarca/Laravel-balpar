<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = ['categoria_catalogo_id', 'imagen', 'nombre', 'archivo'];

    public function categoria(){
        return $this->belongsTo(CategoriaCatalogo::class, 'categoria_catalogo_id');
    }
}
