<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    protected $fillable = [
        'nombre', 'documento', 'telefono', 'email', 'cod_ciudad', 'direccion', 'empresa', 'mensaje',
        'referencias', 'metodo', 'observaciones', 'total', 'monto_envio', 'monto_total', 'estado', 'latitud', 'longitud', 'descuento'
    ];


    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class,'cod_ciudad','id');
    }


    public function finalizar()
    {
        $aux_sql = DB::table('pedido_detalle')->where('pedido_id', $this->attributes['id'])->update(['estado'=>'1']);
        $this->fill(['estado'=>'1'])->save();
        $aux_pedido=Pedido::where('id', $this->attributes['id'])->orderBy('id', 'desc')->first();
        $GLOBALS['email']=$this->attributes['email'];
        $GLOBALS['nombre']=$this->attributes['nombre'];

        //Datos de cofig
        // $color_principal=Opcion::where('name','color_principal')->first();
        $logo = Opcion::where('name','logo')->first();
        $email_empresa = Opcion::where('name','mail')->first();
        $emails_recepcion = Opcion::where('name','mail_pedido')->first();
        $nombre_empresa = Opcion::where('name','nombre_comercio')->first();
        // if ($color_principal==NULL) {
        //     $color_principal='#222021';
        // }else {
        //     $color_principal=$color_principal['value'];
        // }

        if (!$logo==NULL) {
            $logo=$logo['value'];
        }
        if ($emails_recepcion==NULL) {
            $GLOBALS['emailis_copia']=array('carlos.sosa@porta.com.py');
        }else {
            $GLOBALS['emailis_copia'] = explode(',', $emails_recepcion['value']);
            array_push($GLOBALS['emailis_copia'], 'carlos.sosa@porta.com.py');
        }
        if ($email_empresa==NULL) {
            $GLOBALS['email_empresa']='no-reply@empresa.com';
        }else {
            $GLOBALS['email_empresa']=$email_empresa['value'];
        }
        if ($nombre_empresa==NULL) {
            $GLOBALS['nombre_empresa']='Nombre comercio';
        }else {
            $GLOBALS['nombre_empresa']=$nombre_empresa['value'];
        }

        //Datos de cofig
        \Mail::send('emails.confirmacion_compra', [
            'carrito' => $aux_pedido,
            'logo' => $logo,
            'nombre_empresa' =>$GLOBALS['nombre_empresa'],

        ], function ($message) {
            $message->from($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            $message->sender($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            foreach ($GLOBALS['emailis_copia'] as $pos => $aux_email) {
                $message->cc(trim($aux_email), $GLOBALS['nombre_empresa']);
            }
            $message->returnPath('carlos.sosa@porta.com.py');
            $message->to($GLOBALS['email'], $GLOBALS['nombre'])->subject('Confirmación PEDIDO NRO. '.$this->attributes['id']);
            $message->getSwiftMessage();
        });



    }
    public function updateEstado($estado)
    {
        $aux_sql = DB::table('pedido_detalle')->where('pedido_id', $this->attributes['id'])->update(['estado'=>$estado]);
        $this->fill(['estado'=>$estado])->save();
        $aux_pedido=Pedido::where('id', $this->attributes['id'])->orderBy('id', 'desc')->first();
        $GLOBALS['email']=$this->attributes['email'];
        $GLOBALS['nombre']=$this->attributes['nombre'];
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

        //Datos de cofig
        $color_principal=Opcion::where('name','color_principal')->first();
        $logo=Opcion::where('name','logo')->first();
        $email_empresa=Opcion::where('name','mail')->first();
        $emails_recepcion=Opcion::where('name','mail_pedido')->first();
        $nombre_empresa=Opcion::where('name','nombre_comercio')->first();
        if ($color_principal==NULL) {
            $color_principal='#222021';
        }else {
            $color_principal=$color_principal['value'];
        }
        if (!$logo==NULL) {
            $logo=$logo['value'];
        }
        if ($emails_recepcion==NULL) {
            $GLOBALS['emailis_copia']=array();
        }else {
            $GLOBALS['emailis_copia']=explode(',', $email_empresa['value']);
        }
        if ($email_empresa==NULL) {
            $GLOBALS['email_empresa']='no-reply@empresa.com';
        }else {
            $GLOBALS['email_empresa']=$email_empresa['value'];
        }
        if ($nombre_empresa==NULL) {
            $GLOBALS['nombre_empresa']='Nombre comercio';
        }else {
            $GLOBALS['nombre_empresa']=$nombre_empresa['value'];
        }
        //Datos de cofig


        \Mail::send('emails.compra_cambio_estado', [
            'carrito' => $aux_pedido,
            'estado' => $estado,
            'logo' => $logo,
            'color' => $color_principal,
            'nombre_empresa' =>$GLOBALS['nombre_empresa']
        ], function ($message) {
            $message->from($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            $message->sender($GLOBALS['email_empresa'], $GLOBALS['nombre_empresa']);
            foreach ($GLOBALS['emailis_copia'] as $pos => $aux_email) {
                $message->cc(trim($aux_email), $GLOBALS['nombre_empresa']);
            }
            $message->returnPath('desarrollo@porta.com.py');
            $message->to($GLOBALS['email'], $GLOBALS['nombre'])->subject('El pedido PED-'.$this->attributes['id'].' sufrio un cambio de estado.');
            $message->getSwiftMessage();
        });
        return array('status'=>'success', 'mensaje'=>'El pedido cambio de estado y el usuario recibió la notificación.');

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
    public function printDescuento()
    {
        return  'GS. '.number_format ($this->attributes['descuento'],0,",",".");

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

    public function productosPorComma()
    {
        $detalles=PedidoDetalle::where('pedido_id',$this->attributes['id'])->get();
        $productos=array();
        foreach ($detalles as $pos => $detalle) {
            for ($i=0; $i <$detalle['cantidad'] ; $i++) {
                array_push($productos, "'".$detalle->cod_articulo."'");
            }
        }
        return implode($productos,',');

    }




}
