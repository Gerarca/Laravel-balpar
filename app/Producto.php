<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    protected $fillable = [
        'categoria_id', 'marca_id', 'uso_id', 'rubro_id', 'nombre', 'subtitulo', 'cod_articulo', 'descripcion', 'stock',
        'informacion', 'imagen', 'imagen2', 'imagen3', 'imagen4', 'visible', 'destacado_comercial', 'destacado_industrial'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function uso(){
        return $this->belongsTo(Uso::class);
    }

    public function rubro(){
        return $this->belongsTo(Rubro::class);
    }

    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class)->withTimestamps();
    }

}
