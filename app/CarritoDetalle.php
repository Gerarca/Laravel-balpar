<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CarritoDetalle extends Model
{
  protected $table = 'carrito_detalle';

  protected $fillable = [

    'carrito_id','user_id','cod_articulo','cantidad','producto','categoria_id','categoria','imagen','precio','total', 'estado'

  ];
  public function producto()
   {
       return $this->belongsTo(Producto::class);
   }
  public function carrito()
   {
       return $this->belongsTo(Carrito::class);
   }
  public function usuario()
   {
       return $this->belongsTo(User::class);
   }
  public function updateCantidad($cantidad)
   {

     $producto=Producto::where('cod_articulo',$this->attributes['cod_articulo'])->first();
     if ($cantidad>=1 && $producto<>NULL) {
       $this->fill(['cantidad'=>$cantidad, 'precio'=> $producto->getPrecio(), 'total' => $producto->getPrecio()*$cantidad])->save();
     }else {
       $this->delete();
     }
     $this->carrito->limpiar();
     $this->carrito->recalcularTotal();
   }

   public function printTotal()
    {
        return  'GS. '.number_format ($this->attributes['total'],0,",",".");

    }
   public function printPrecio()
    {
          return  'GS. '.number_format ($this->attributes['precio'],0,",",".");

    }
   public function productoStock()
    {
      $producto=Producto::where('cod_articulo',$this->attributes['cod_articulo'])->first();
      return  $producto->stock();

    }

}
