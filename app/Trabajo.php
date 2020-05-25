<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $fillable = ['categoria_id', 'imagen', 'nombre', 'descripcion'];

    public function categoria(){
        return $this->belongsTo(CategoriaTrabajo::class);
    }
}
