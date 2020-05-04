<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $fillable = ['categoria_id', 'rubro'];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function productos(){
        return $this->hasMany(Producto::class);
    }
    
}
