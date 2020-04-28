<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\presto\Presto;
use App\aex\AEX;

class Producto extends Model
{
  protected $table = 'productos';

  protected $fillable = [
    'titulo', 'hash_update', 'cod_articulo', 'imagen', 'categoria_id', 'marca_id', 'descripcion', 'especificaciones', 'user_id', 'visible', 'oferta_semana', 'visitas', 'recomendado','mas_vendido', 'proveedor_id', 'peso', 'alto', 'largo', 'ancho', 'costo', 'sku', 'precio_retail', 'stock', 'tamano', 'referencia', 'codigo_barra'
  ];

  protected $primaryKey = 'cod_articulo';
 public $incrementing = false;

  public function categoria(){

    return $this->belongsTo(Categoria::class);
  }
  public function marca(){
    return $this->belongsTo(Marca::class);
  }
  public function imagenes(){
    return $this->hasMany('App\ImagenProducto', 'cod_articulo')->orderBy('orden','desc');
  }

  	public function cuotas(){
		return $this->hasMany(CuotaProducto::class, 'cod_articulo', 'cod_articulo');
  	}

  public function guardarEtiqueta($etiqueta, $id_user=0){

    if ($etiqueta>=1) {
      $this->etiquetas()->syncWithoutDetaching([$etiqueta]);

    }else {
      $id = DB::table('etiquetas')->insertGetId(
          ['titulo' => $etiqueta, 'user_id'=>$id_user]
      );

      $this->etiquetas()->syncWithoutDetaching([$id]);
      $etiqueta=$id;
    }
    return $etiqueta;
  }
  public function guardarEtiquetas($etiquetas, $id_user=0){
    $not_id=array();
    if (is_array($etiquetas) && sizeof($etiquetas)>=1) {
      foreach ($etiquetas as $etiqueta) {
        $aux_id=$this->guardarEtiqueta($etiqueta, $id_user);
        array_push($not_id, $aux_id);
      }
    }
    DB::table('etiqueta_producto')->where('cod_articulo',$this->attributes['cod_articulo'])->whereNotIn('etiqueta_id', $not_id)->delete();
    return true;

  }
  public function etiquetasNoSeleccionadas($cod_articulo=''){
    if (strlen($cod_articulo)>=1) {
      return $etiquetas_no_seleccionadas_query=Etiqueta::whereDoesntHave(
        'productos', function($q) use ($cod_articulo){
          $q->where('productos.cod_articulo', $cod_articulo);
        }
        )->get();
    }else {
      return Etiqueta::all();
    }
  }

  public function etiquetas(){
    // return $this->belongsToMany('App\Etiqueta', 'etiqueta_producto', 'cod_articulo', 'etiqueta_id');
    return $this->belongsToMany('App\Etiqueta', 'etiqueta_producto', 'cod_articulo', 'etiqueta_id');
  }

  public function guardarColor($color, $id_user=0){

    if ($color>=1) {
      $this->colores()->syncWithoutDetaching([$color]);

    }else {
      $id = DB::table('colores')->insertGetId(
          ['titulo' => $color, 'user_id'=>$id_user]
      );

      $this->colores()->syncWithoutDetaching([$id]);
      $color=$id;
    }
    return $color;
  }
  public function guardarColores($colores, $id_user=0){
    $not_id=array();
    if (is_array($colores) && sizeof($colores)>=1) {
      foreach ($colores as $color) {
        $aux_id=$this->guardarColor($color, $id_user);
        array_push($not_id, $aux_id);
      }
    }
    DB::table('color_producto')->where('cod_articulo',$this->attributes['cod_articulo'])->whereNotIn('color_id', $not_id)->delete();
    return true;

  }
  public function coloresNoSeleccionadas($cod_articulo=''){
    if (strlen($cod_articulo)>=1) {
      return $colores_no_seleccionadas_query=Color::whereDoesntHave(
        'productos', function($q) use ($cod_articulo){
          $q->where('productos.cod_articulo', $cod_articulo);
        }
        )->get();
    }else {
      return Color::all();
    }
  }

  public function colores(){
    return $this->belongsToMany('App\Color', 'color_producto', 'cod_articulo', 'color_id');
  }

  public function guardarTamano($tamano, $id_user=0){

    if ($tamano>=1) {
      $this->tamanos()->syncWithoutDetaching([$tamano]);

    }else {
      $id = DB::table('tamanos')->insertGetId(
          ['titulo' => $tamano, 'user_id'=>$id_user]
      );

      $this->tamanos()->syncWithoutDetaching([$id]);
      $tamano=$id;
    }
    return $tamano;
  }
  public function guardarTamanos($tamanos, $id_user=0){
    $not_id=array();
    if (is_array($tamanos) && sizeof($tamanos)>=1) {
      foreach ($tamanos as $tamano) {
        $aux_id=$this->guardarTamano($tamano, $id_user);
        array_push($not_id, $aux_id);
      }
    }
    DB::table('tamano_producto')->where('cod_articulo',$this->attributes['cod_articulo'])->whereNotIn('tamano_id', $not_id)->delete();
    return true;

  }
  public function tamanosNoSeleccionadas($cod_articulo=''){
    if (strlen($cod_articulo)>=1) {
      return $tamanos_no_seleccionadas_query=Tamano::whereDoesntHave(
        'productos', function($q) use ($cod_articulo){
          $q->where('productos.cod_articulo', $cod_articulo);
        }
        )->get();
    }else {
      return Tamano::all();
    }
  }

  public function tamanos(){
    // return $this->belongsToMany('App\Tamano', 'tamano_producto', 'cod_articulo', 'tamano_id');
    return $this->belongsToMany('App\Tamano', 'tamano_producto', 'cod_articulo', 'tamano_id');
  }
  public function getPrecio(){
    return $this->attributes['precio_retail'];

  }
  public function getPrecioCuota($cuota, $documento=0){
    $var_monto=$this->attributes['precio_retail'];
    $presto= new Presto;
    $calculo=$presto->SimuladorPrestamos($documento, $var_monto, $cuota);
    $calculo=($calculo['Data']['Wcuota']>=1)?$calculo['Data']['Wcuota']:0;
    return $calculo;
  }
  public function precio(){
    return  'GS '.number_format ($this->attributes['precio_retail'],0,",",".");

  }
  public function precioAnterior(){

    return  '';

  }

  public function stock(){
    $aex= new AEX;
    $inventario=$aex->inventario([$this->attributes['cod_articulo']]);
    if (($inventario['datos']) && (is_array($inventario['datos'])) && ($inventario['datos'][0]['existencia']>=1)) {
      return round($inventario['datos'][0]['existencia']);
    }else {
      return 0;
    }
  }


  public function calculoVisibilidad(){
    $stock=$this->stock();
    if (!$stock>=1) {
      $producto=Producto::where('cod_articulo', $this->attributes['cod_articulo'])->first();
      $producto->fill([
          'visible'=>'0'
          ])->save();
    }
  }

  public function getMinimo(){
    $cuotas=18;
    $minimo=$this->getPrecioCuota($cuotas);
    if (!$minimo>=1) {
      $cuotas=12;
      $minimo=$this->getPrecioCuota($cuotas);
      if (!$minimo>=1) {
        $cuotas=9;
        $minimo=$this->getPrecioCuota($cuotas);
        if (!$minimo>=1) {
          $cuotas=6;
          $minimo=$this->getPrecioCuota($cuotas);
        }
      }
    }
    if (!$minimo>=1) {
      $minimo=$this->getPrecio();
      $cuotas=0;
    }
    return array('cuotas'=>$cuotas, 'valor'=>$minimo);
  }
  public function printMinimo(){
    $valor=$this->getMinimo();
    if ($valor['cuotas']>=1) {
      return  'Cuotas desde '.number_format ($valor['valor'],0,",",".");
    }else {
      return  'GS '.number_format ($valor['valor'],0,",",".");
    }

  }


}
