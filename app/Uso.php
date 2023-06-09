<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uso extends Model
{
    protected $fillable = ['categoria_id', 'uso'];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function productos(){
        return $this->hasMany(Producto::class);
    }
    
}
