<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Carrito extends Model
{
  protected $table = 'carrito';

  protected $fillable = [
    'user_id', 'total', 'monto_envio', 'monto_total', 'estado', 'fecha_compra', 'uuid', 'pais', 'departamento', 'cod_ciudad', 'ciudad', 'barrio', 'direccion', 'celular', 'telefono', 'comentarios', 'calle_principal', 'calle_secundaria', 'latitud', 'longitud', 'referencia', 'referencias', 'documento', 'respuesta', 'aex_cod_metodo', 'aex_tipo_entrega', 'aex_cod_extras', 'fecha_tracking', 'aex_enviado', 'aex_id_solicitud','cod_metodo' , 'metodo', 'nombre',
  ];


  public function detalles()
   {
       return $this->hasMany(CarritoDetalle::class);

   }
   public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function recalcularTotal()
    {
      $nuevoTotal = DB::table('carrito_detalle')->where('carrito_id', $this->attributes['id'])->sum('total');
      $this->fill(['total'=>$nuevoTotal, 'monto_total'=>($nuevoTotal+$this->attributes['monto_envio'])])->save();


    }
    public function finalizar()
    {
      $usuario=User::where('id', $this->attributes['user_id'])->orderBy('id', 'desc')->first();
      $aux_sql = DB::table('carrito_detalle')->where('carrito_id', $this->attributes['id'])->update(['estado'=>'1']);
      $this->fill(['estado'=>'1'])->save();
      $aux_carrito=Carrito::where('id', $this->attributes['id'])->orderBy('id', 'desc')->first();
      $GLOBALS['email']=$usuario->email;
      $GLOBALS['nombre']=$usuario->name;
      \Mail::send('emails.confirmacion_compra', [
        'carrito' => $aux_carrito,

      ], function ($message) {
            $message->from('desarrollo@porta.com.py', 'Desarrollo Porta');
            $message->sender('desarrollo@porta.com.py', 'Desarrollo Porta');
            $message->returnPath('desarrollo@porta.com.py');
            $message->cc('desarrollo@porta.com.py', 'Desarrollo Porta');
            $message->to($GLOBALS['email'], $GLOBALS['nombre'])->subject('Confirmación de compra PEDIDO NRO. '.$this->attributes['id']);
            $message->getSwiftMessage();
        });



    }
    public function updateEstado($estado)
    {
      if ($estado==2) {
        $aexApi=new aex\Aex;
        if (strlen($aexApi->codigo_autorizacion)>=1 && $aexApi->codigo_autorizacion<>'error') {
          $carrito=Carrito::where('id', $this->attributes['id'])->first();
          $paquetes=array();
          foreach ($carrito->detalles as $pos => $detalle) {
            $producto=Producto::where('cod_articulo', $detalle->cod_articulo)->first();
            for ($i=0; $i <$detalle->cantidad ; $i++) {
              array_push($paquetes, array(
                'peso' => $producto->peso, 'largo' => $producto->largo, 'alto' => $producto->alto, 'ancho' => $producto->ancho, 'valor' => $detalle->precio, 'descripcion' =>$producto->titulo, 'codigo_externo'=>$carrito->id.'_'.$producto->cod_articulo, 'codigo_producto'=>$producto->cod_articulo
              ));
            }
          }
          $solicitud=$aexApi->solicitar_servicio($carrito->cod_ciudad, 'PY1109', $paquetes,$carrito->id);
          if (!($solicitud['codigo']==0)) {
            return array('status'=>'error', 'mensaje'=>'Error de conexion con AEX y no se pudo solicitar el servicio, favor volver a intentar en unos minutos...');

          }
          $id_solicitud_aex=$solicitud['datos']['id_solicitud'];
          $array_adicionales=explode('-', $carrito->aex_cod_extras);
          $telefonos_array=array();
					$telefonos_array[0]=array('numero'=>$carrito->celular,'denominacion'=>'Celular');
					$telefonos_array[1]=array('numero'=>(strlen($carrito->telefono)>=1)?$carrito->telefono:$carrito->celular,'denominacion'=>'Teléfono');
					$destinatario=array(
						'codigo'=>$carrito->user_id,
						'numero_documento'=>$carrito->documento,
						'nombre'=>$carrito->nombre,
						'Email'=>$carrito->usuario->email,
						'telefonos'=>$telefonos_array
					);
          $entrega=array(
  					'codigo'=>'02'.$carrito->user_id,
  					'calle_principal'=>$carrito->calle_principal,
  					'calle_transversal_1'=>$carrito->calle_secundaria,

  					'codigo_ciudad'=>$carrito->cod_ciudad,
  					'telefono'=>(strlen($carrito->telefono)>=1)?$carrito->telefono:$carrito->celular,
  					'telefono_movil'=>$carrito->celular,
  					'latitud'=>$carrito->latitud,
  					'longitud'=>$carrito->longitud,
  					'Comentario'=>$carrito->referencias
  				);
					$confirmacion_envio= $aexApi -> confirmar_servicio( $id_solicitud_aex, $carrito->aex_cod_metodo, $destinatario, $entrega, $carrito->id, $array_adicionales);
          if ($confirmacion_envio['codigo']==0) {
            $carrito->calcularStockDeProductos();
            $carrito->fill([
              'aex_id_solicitud'=>$confirmacion_envio['datos']['numero_guia'],
              'fecha_tracking'=>date('Y-m-d H:i:s'),
              'aex_enviado'=>'1'
              ])->save();
					}else {
            return array('status'=>'error', 'mensaje'=>'Error de conexion con AEX y no se pudo confirmar el servicio, favor volver a intentar en unos minutos.');
          }
        }
      }
      $usuario=User::where('id', $this->attributes['user_id'])->orderBy('id', 'desc')->first();
      $aux_sql = DB::table('carrito_detalle')->where('carrito_id', $this->attributes['id'])->update(['estado'=>$estado]);
      $this->fill(['estado'=>$estado])->save();
      $aux_carrito=Carrito::where('id', $this->attributes['id'])->orderBy('id', 'desc')->first();
      $GLOBALS['email']=$usuario->email;
      $GLOBALS['nombre']=$usuario->name;
      if ($this->attributes['estado']==0) {
        $estado = 'Abierto';
      }elseif ($this->attributes['estado']==1) {
        $estado = 'Pendiente';
      }elseif ($this->attributes['estado']==2) {
        $estado = 'Confirmado / Enviado';
      }elseif ($this->attributes['estado']==3) {
        $estado = 'Rechazado';
      }else {
        $estado = 'Paso a solicitud de crédito';
      }
      \Mail::send('emails.compra_cambio_estado', [
        'carrito' => $aux_carrito,
        'estado' => $estado
      ], function ($message) {
            $message->from('desarrollo@porta.com.py', 'Desarrollo Porta');
            $message->sender('desarrollo@porta.com.py', 'Desarrollo Porta');
            $message->returnPath('desarrollo@porta.com.py');
            $message->cc('desarrollo@porta.com.py', 'Desarrollo Porta');
            $message->to($GLOBALS['email'], $GLOBALS['nombre'])->subject('El pedido PED-'.$this->attributes['id'].' sufrio un cambio de estado.');
            $message->getSwiftMessage();
        });
        return array('status'=>'success', 'mensaje'=>'El pedido cambio de estado y el usuario recibió la notificación.');

    }
   public function addProducto($cod_articulo, $cantidad=1)
    {
      $producto=Producto::where('cod_articulo',$cod_articulo)->first();


      if ($producto == NULL) {
        return ['error'=>'No se enuentra el producto solicitado'];
      }
      $detalle=CarritoDetalle::where('carrito_id', $this->attributes['id'])->where('cod_articulo', $cod_articulo)->where('estado','0')->orderBy('id', 'desc')->first();
      if ($detalle == NULL) {
        if (($producto->stock()<$cantidad)) {
          return ['respuesta'=>'error', 'error'=>'No existe stock suficiente para agregar al carrito'];
        }
        $detalle=CarritoDetalle::create([
          'carrito_id'=>$this->attributes['id'],
           'user_id'=>$this->attributes['user_id'],
           'cod_articulo' => $producto->cod_articulo,
           'cantidad'=>$cantidad,
           'producto'=>$producto->titulo,
           'categoria_id'=>$producto->categoria_id,
           'imagen'=>$producto->imagen,
           'precio'=>$producto->getPrecio(),
           'total'=>$producto->getPrecio()*$cantidad,
         ]);
      }else {
        $nueva_cantidad=$detalle->cantidad+$cantidad;
        if (($producto->stock()<$nueva_cantidad)) {
          return ['respuesta'=>'error', 'error'=>'No existe stock suficiente para agregar al carrito'];
        }
        $detalle->fill(['cantidad'=>$nueva_cantidad, 'precio' => $producto->getPrecio(), 'total'=>$nueva_cantidad*$producto->getPrecio()])->save();
      }

      $this->recalcularTotal();

      return ['success'=>'El producto fue agregado de manera exitosa'];


    }
    public function printMontoTotal()
     {
         return  'GS. '.number_format ($this->attributes['monto_total'],0,",",".");

     }
    public function printTotal()
     {
         return  'GS. '.number_format ($this->attributes['total'],0,",",".");

     }
    public function printMontoEnvio()
     {
         return  'GS. '.number_format ($this->attributes['monto_envio'],0,",",".");

     }
    public function printEstado()
     {
       if ($this->attributes['estado']==0) {
         $estado = 'Abierto'; $color = 'info';
       }elseif ($this->attributes['estado']==1) {
         $estado = 'Pendiente'; $color = 'danger';
       }elseif ($this->attributes['estado']==2) {
         $estado = 'Confirmado / Enviado'; $color = 'success';
       }elseif ($this->attributes['estado']==3) {
         $estado = 'Rechazado'; $color = 'danger black-background white';
       }else {
        $estado = 'Paso a solicitud de crédito'; $color = 'danger black-background white';
       }

         return  '<a href="javascript:void(0)" class="btn btn-sm btn-'.$color.'"><i class="fa fa-shopping-cart"></i> '.$estado.'</a>';

     }
     public function limpiar()
     {
       $carrito=Carrito::where('id', $this->attributes['id'])->first();

       foreach ($carrito->detalles as $pos => $detalle) {
         $producto=Producto::where('cod_articulo', $detalle->cod_articulo)->first();
         if ($producto->stock()<$detalle->cantidad) {
           if ($producto->stock()<1) {
             $detalle->delete();
           }else {
             $detalle->fill([
               'cantidad'=>$producto->stock(),
               'precio'=>$producto->getPrecio(),
               'total'=>$producto->getPrecio()*$producto->stock(),
               ])->save();
           }
           $this->recalcularTotal();
         }else {
           $detalle->fill([
             'precio'=>$producto->getPrecio(),
             'total'=>$producto->getPrecio()*$detalle->cantidad,
             ])->save();
             $this->recalcularTotal();

         }

       }
     }
     public function calcularStockDeProductos()
     {
       $carrito=Carrito::where('id', $this->attributes['id'])->first();
       foreach ($carrito->detalles as $pos => $detalle) {
         $producto=Producto::where('cod_articulo', $detalle->cod_articulo)->first();
         $producto->calculoVisibilidad();
       }
     }
     public function productosPorComma()
     {
       $detalles=CarritoDetalle::where('carrito_id',$this->attributes['id'])->get();
       $productos=array();
       foreach ($detalles as $pos => $detalle) {
         for ($i=0; $i <$detalle['cantidad'] ; $i++) {
           array_push($productos, $detalle->cod_articulo);
         }
       }
       return implode($productos,',');

     }
     public function productosPorCommaSKU()
     {
       $detalles=CarritoDetalle::where('carrito_id',$this->attributes['id'])->get();
       $productos=array();
       foreach ($detalles as $pos => $detalle) {
         for ($i=0; $i <$detalle['cantidad'] ; $i++) {
           $producto=Producto::where('cod_articulo', $detalle->cod_articulo)->first();
           array_push($productos, $producto->sku);
         }
       }
       return implode($productos,',');

     }

     public function vpos()
    {
        return $this->hasMany('App\Vpos', 'mi_carrito', 'id');
    }

}
