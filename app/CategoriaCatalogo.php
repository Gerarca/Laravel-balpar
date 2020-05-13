<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaCatalogo extends Model
{
    protected $fillable = ['nombre'];

    public function catalogos(){
        return $this->hasMany(Catalogo::class, 'categoria_catalogo_id');
    }
}
