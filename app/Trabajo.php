<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $fillable = ['categoria_id', 'imagen', 'video', 'nombre', 'descripcion', 'tipo'];

    public function categoria(){
        return $this->belongsTo(CategoriaTrabajo::class);
    }
}
