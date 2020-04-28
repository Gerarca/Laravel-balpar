<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Carrito;
use App\User;
use DateTime;

class ReporteController extends Controller
{
  public function __construct(Carrito $carritos, User $usuarios)
  {
    $this->middleware('auth');
    $this->carritos=$carritos;
    $this->usuarios=$usuarios;
  }

    public function ventas()
    {
      $desde    = new DateTime('first day of this month');
      $hasta    = new DateTime('last day of this month');
      $ventas=DB::table('carrito')
      ->select(DB::raw('DATE(fecha_compra) as date'), DB::raw('sum(monto_total) as value'))
      ->where('estado',2)
      ->whereBetween('fecha_compra', [date('Y-m-d H:i:s',strtotime($desde->format('Y-m-d')." 00:00:00")), date('Y-m-d H:i:s',strtotime($hasta->format('Y-m-d')." 00:00:00"))])
      ->groupBy('date')
      ->get();
      $desde      = $desde->format('d/m/Y');
      $hasta      = $hasta->format('d/m/Y');
    	return view('panel.reportes.venta', compact('ventas', 'desde', 'hasta'));
    }
    public function ventasAjax(Request $request)
    {
      $array_desde=explode('/', $request->desde);
      $array_hasta=explode('/', $request->hasta);
      $from = date('Y-m-d',strtotime($array_desde[2].'-'.$array_desde[1].'-'.$array_desde[0]));
      $to = date('Y-m-d',strtotime($array_hasta[2].'-'.$array_hasta[1].'-'.$array_hasta[0]));
      DB::enableQueryLog();
      $ventas=DB::table('carrito')
      ->select(DB::raw('DATE(fecha_compra) as date'), DB::raw('sum(monto_total) as value'))
      ->where('estado',2)
      ->whereBetween('fecha_compra', [date('Y-m-d H:i:s',strtotime($from." 00:00:00")), date('Y-m-d H:i:s',strtotime($to." 00:00:00"))])
      ->groupBy('date')
      ->get();


      return response()->json($ventas);
    }



    public function usuarios()
    {
      $desde    = new DateTime('first day of this month');
      $hasta    = new DateTime('last day of this month');
      $usuarios=DB::table('users')
      ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as value'))
      ->whereBetween('created_at', [date('Y-m-d H:i:s',strtotime($desde->format('Y-m-d')." 00:00:00")), date('Y-m-d H:i:s',strtotime($hasta->format('Y-m-d')." 00:00:00"))])
      ->groupBy('date')
      ->get();
      $desde      = $desde->format('d/m/Y');
      $hasta      = $hasta->format('d/m/Y');
    	return view('panel.reportes.usuario', compact('usuarios', 'desde', 'hasta'));
    }
    public function usuariosAjax(Request $request)
    {
      $array_desde=explode('/', $request->desde);
      $array_hasta=explode('/', $request->hasta);
      $from = date('Y-m-d',strtotime($array_desde[2].'-'.$array_desde[1].'-'.$array_desde[0]));
      $to = date('Y-m-d',strtotime($array_hasta[2].'-'.$array_hasta[1].'-'.$array_hasta[0]));
      DB::enableQueryLog();
      $usuarios=DB::table('users')
      ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as value'))
      ->whereBetween('created_at', [date('Y-m-d H:i:s',strtotime($from." 00:00:00")), date('Y-m-d H:i:s',strtotime($to." 00:00:00"))])
      ->groupBy('date')
      ->get();


      return response()->json($usuarios);
    }

    public function productos()
    {
      $desde    = new DateTime('first day of this month');
      $hasta    = new DateTime('last day of this month');
      $productos=DB::table('carrito_detalle')
      ->select(DB::raw('productos.titulo as state'), DB::raw('sum(cantidad) as sales') )
      ->leftJoin( 'productos', 'carrito_detalle.cod_articulo', '=', 'productos.cod_articulo' )
      ->whereBetween('carrito_detalle.created_at', [date('Y-m-d H:i:s',strtotime($desde->format('Y-m-d')." 00:00:00")), date('Y-m-d H:i:s',strtotime($hasta->format('Y-m-d')." 00:00:00"))])
      ->groupBy('carrito_detalle.cod_articulo')
      ->get();
      $desde      = $desde->format('d/m/Y');
      $hasta      = $hasta->format('d/m/Y');
      // dd($productos);
    	return view('panel.reportes.producto', compact('productos', 'desde', 'hasta'));
    }
    public function productosAjax(Request $request)
    {
      $array_desde=explode('/', $request->desde);
      $array_hasta=explode('/', $request->hasta);
      $from = date('Y-m-d',strtotime($array_desde[2].'-'.$array_desde[1].'-'.$array_desde[0]));
      $to = date('Y-m-d',strtotime($array_hasta[2].'-'.$array_hasta[1].'-'.$array_hasta[0]));
      $productos=DB::table('carrito_detalle')
      ->select(DB::raw('productos.titulo as state'), DB::raw('sum(cantidad) as sales') )
      ->leftJoin( 'productos', 'carrito_detalle.cod_articulo', '=', 'productos.cod_articulo' )
      ->whereBetween('carrito_detalle.created_at', [date('Y-m-d H:i:s',strtotime($from." 00:00:00")), date('Y-m-d H:i:s',strtotime($to." 00:00:00"))])
      ->groupBy('carrito_detalle.cod_articulo')
      ->get();
      return response()->json($productos);
    }
    public function marcas()
    {
      $desde    = new DateTime('first day of this month');
      $hasta    = new DateTime('last day of this month');
      $marcas=DB::table('carrito_detalle')
      ->select(DB::raw('productos.titulo as region'), DB::raw('sum(cantidad) as sales'), DB::raw('marcas.titulo as state') )
      ->leftJoin( 'productos', 'carrito_detalle.cod_articulo', '=', 'productos.cod_articulo' )
      ->leftJoin( 'marcas', 'marcas.id', '=', 'productos.marca_id' )
      ->whereBetween('carrito_detalle.created_at', [date('Y-m-d H:i:s',strtotime($desde->format('Y-m-d')." 00:00:00")), date('Y-m-d H:i:s',strtotime($hasta->format('Y-m-d')." 00:00:00"))])
      ->groupBy('carrito_detalle.cod_articulo')
      ->get();
      $desde      = $desde->format('d/m/Y');
      $hasta      = $hasta->format('d/m/Y');
      $array_marcas=array();
      foreach ($marcas as $pos => $marca) {
        if (!(isset($array_marcas[$marca->state]))) {
          $array_marcas[$marca->state]=0;
        }
        $array_marcas[$marca->state]+=$marca->sales;
      }
      $arrayJson=array();
      foreach ($array_marcas as $pos => $cantidad) {
        $object = new \stdClass();
        $object->state=$pos;
        $object->region=$pos;
        $object->sales=$cantidad;
        array_push($arrayJson, $object);
      }
      $marcas=$arrayJson;
    	return view('panel.reportes.marca', compact('marcas', 'desde', 'hasta'));
    }
    public function marcasAjax(Request $request)
    {
      $array_desde=explode('/', $request->desde);
      $array_hasta=explode('/', $request->hasta);
      $from = date('Y-m-d',strtotime($array_desde[2].'-'.$array_desde[1].'-'.$array_desde[0]));
      $to = date('Y-m-d',strtotime($array_hasta[2].'-'.$array_hasta[1].'-'.$array_hasta[0]));
      $marcas=DB::table('carrito_detalle')
      ->select(DB::raw('productos.titulo as region'), DB::raw('sum(cantidad) as sales'), DB::raw('marcas.titulo as state') )
      ->leftJoin( 'productos', 'carrito_detalle.cod_articulo', '=', 'productos.cod_articulo' )
      ->leftJoin( 'marcas', 'marcas.id', '=', 'productos.marca_id' )
      ->whereBetween('carrito_detalle.created_at', [date('Y-m-d H:i:s',strtotime($from." 00:00:00")), date('Y-m-d H:i:s',strtotime($to." 00:00:00"))])
      ->groupBy('carrito_detalle.cod_articulo')
      ->get();
      $array_marcas=array();
      foreach ($marcas as $pos => $marca) {
        if (!(isset($array_marcas[$marca->state]))) {
          $array_marcas[$marca->state]=0;
        }
        $array_marcas[$marca->state]+=$marca->sales;
      }
      $arrayJson=array();
      foreach ($array_marcas as $pos => $cantidad) {
        $object = new \stdClass();
        $object->state=$pos;
        $object->region=$pos;
        $object->sales=$cantidad;
        array_push($arrayJson, $object);
      }
      $marcas=$arrayJson;
      return response()->json($marcas);
    }
}
