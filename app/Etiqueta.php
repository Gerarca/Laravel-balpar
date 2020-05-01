<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $table = 'etiquetas';

    protected $fillable = ['nombre'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

}
