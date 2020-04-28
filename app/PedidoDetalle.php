<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PedidoDetalle extends Model
{
  protected $table = 'pedido_detalle';

  protected $fillable = [

    'pedido_id', 'cod_articulo', 'cantidad', 'precio', 'total', 'estado','variacion'

  ];
  public function producto()
   {
       return $this->belongsTo(Producto::class, 'cod_articulo', 'cod_articulo');
   }
  public function pedido()
   {
       return $this->belongsTo(Pedido::class);
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
