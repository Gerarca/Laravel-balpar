<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  protected $table = 'categorias';

  protected $fillable = [
    'titulo', 'imagen', 'cod_padre', 'orden', 'user_id', 'id', 'cod_origen'
  ];

  public function getPadres(){
    $array=array();
    $aux=$this->getPadre($this->attributes['cod_padre']);
    while (sizeof($aux)>=1) {
      array_push($array, $aux[0]);
      $aux=$this->getPadre($aux[0]->cod_padre);
    }
    return array_reverse($array);

  }
  public function getHijosCompleto(){
    $array=array();
    // if ($this->attributes['cod_padre']>=1) {
    //   $aux=$this->getHijoCompleto($this->attributes['cod_padre']);
    //   while (sizeof($aux)>=1) {
    //     array_push($array, $aux[0]);
    //     $aux=$this->getHijoCompleto($aux[0]->id);
    //   }
    // }else {
    // }
    $aux=$this->getHijoCompleto($this->attributes['id']);
    while (sizeof($aux)>=1) {
      foreach ($aux as $pos => $ee) {
        array_push($array, $ee);
        $aux=$this->getHijoCompleto($ee->id);
      }
    }
    return array_reverse($array);
  }
  public function getHijoCompleto($cod_padre){
    return Categoria::where('cod_padre',$cod_padre)
    ->orderBy('orden', 'asc')->get();
  }

  public function getPadresConHijos($cod_padre=NULL){
    $aux = Categoria::where('cod_padre',$cod_padre)
    ->orderBy('orden', 'asc')->get();
    foreach ($aux as  $neo_aux) {
      $neo_aux->hijos=$this->getPadresConHijos($neo_aux->id);
    }
    return $aux;
  }
  public function getAll(){
    return Categoria::where('cod_padre',NULL)
    ->orderBy('orden', 'asc')->get();
  }
  public function getPadre($cod_padre){
    return Categoria::where('id',$cod_padre)
    ->orderBy('orden', 'asc')->get();
  }

  public function getHijos(){
    return Categoria::where('cod_padre',$this->attributes['id'])
    ->orderBy('orden', 'asc')->get();
  }
  public function jerarquia(){
    $c=1;
    $aux=$this->getPadre($this->attributes['cod_padre']);
    while (sizeof($aux)>=1) {
      $c=$c+1;
      $aux=$this->getPadre($aux[0]->cod_padre);
    }
    return $c;
  }
  public function productos(){

    return $this->hasMany(Producto::class);

  }
  public function marcasDestacadas(){
    return Marca::where('destacado',1)->where('id_categoria',$this->attributes['id'])->get();
  }

}
