<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioTecnicoInfo extends Model
{
    protected $table = 'servicio_tecnico_info';

    protected $fillable = [
        'type',
        'youtube_id',
        'image'
    ];
}
