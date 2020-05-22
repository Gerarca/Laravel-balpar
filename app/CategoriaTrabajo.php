<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaTrabajo extends Model
{
    protected $fillable = ['categoria'];

    public function trabajos(){
        return $this->hasMany(Trabajo::class, 'categoria_id');
    }
}
