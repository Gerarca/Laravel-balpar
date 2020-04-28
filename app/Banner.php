<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $table = 'banners';

  protected $fillable = [
    'titulo', 'enlace', 'imagen', 'orden', 'user_id', 'tipo_vencimiento', 'vencimiento', 'visible','tipo_banner'
  ];
}
