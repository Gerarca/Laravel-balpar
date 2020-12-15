<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Str;

class Blog extends Model
{
  protected $table = 'blogs';

  protected $fillable = [
      'fecha', 'titulo', 'imagen', 'contenido', 'visible', 'categoria_id', 'user_id'
  ];

  public function categoria(){
    return $this->belongsTo(Categoria::class);
  }
  public function user(){
    return $this->belongsTo(User::class);
  }
  public function getFechaFormatAttribute()
  {
     $date = $this->attributes['fecha'];
     $dateObject = Carbon::createFromFormat("Y-m-d",$date);
     return $dateObject->format("d/m/Y");
  }
  public function getImagenUrlAttribute()
  {
     return isset($this->attributes['imagen']) ? url('uploads/'.$this->attributes['imagen']) : null;
  }
  public function getVisibleFormatAttribute()
  {
     return $this->attributes['visible'] == true ? 'Sí' : 'No';
  }
  public function getResumenContenidoAttribute(){
    return str_limit($this->attributes['contenido'], 180);
  }
  public function fullURL(){
    return route('front.blog.single', $this->routeParams());
  }
  public function routeParams(){
      return [
          $this->id,
          Str::slug($this->titulo),
      ];
  }
}
