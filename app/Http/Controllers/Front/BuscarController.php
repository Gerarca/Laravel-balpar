<?php


namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;


use DB;
use App\Categoria;
use App\Producto;
use App\Etiqueta;
use App\Tamano;
use App\Color;
use App\Marca;


class BuscarController extends Controller
{
    public function __construct( Categoria $categorias, Producto $productos)
    {
        $this->categorias = $categorias;
        $this->productos = $productos;
    }

    public function ver( Request $request)
    {



        $marcas=Marca::orderBy('orden', 'asc')->get();
        $categorias_filtro=Categoria::where('cod_padre',NULL)->orderBy('orden', 'asc')->get();

        $precio_retail_maximo =Producto::where('visible', 1)->max('precio_retail');
        $precio_retail_minimo =Producto::where('visible', 1)->min('precio_retail');
        $rangos = [];
        $rango_fin = $precio_retail_minimo;
        $paso = 500000;

        // while ($rango_fin < $precio_retail_maximo) {
        //     $rango_inicio = (int)round($rango_fin / 1000) * 1000;
        //     $rango_fin = (int)round(($rango_fin + $paso) / 1000) * 1000;
        //     $rangos[] = [$rango_inicio, $rango_fin, 0];
        // }
        $cant_pag = $request->cantPagina ?? 20;
        if (isset($request->orderby) && $request->orderby>=0) {
          if ($request->orderby==1) {
            $aux_oder='precio_retail desc';
          }elseif ($request->orderby==2) {
            $aux_oder='precio_retail asc';
          }elseif ($request->orderby==2) {
              $aux_oder='id desc';
          }elseif ($request->orderby==3) {
              $aux_oder='descuento desc';
          }else {
            $aux_oder='id asc';
          }
        }else {
          $aux_oder='id asc';
        }

        $productos = $this->productos->where('visible', 1)->where(
          function ($query) use($request, $rangos) {

              if (isset($request->rango) && $request->rango>=0 && $request->rango<>'all') {
                $query->whereBetween('precio_retail', [$rangos[$request->rango][0], $rangos[$request->rango][1]]);
              }
              if (isset($request->s) && strlen($request->s)>=1) {
                $columnas_a_buscar = [
                    'titulo', 'cod_articulo', 'descripcion', 'especificaciones', 'codigo_barra', 'referencia'
                ];
                $query->where(function ($query_sub) use ($request, $columnas_a_buscar) {
                  foreach ($columnas_a_buscar as $columna) {
                      $query_sub->orWhere($columna, 'LIKE', '%' . $request->s . '%');
                  }
                });
              }
            }
          )->orderByRaw($aux_oder)->paginate($cant_pag);
        return view('front.buscar.ver', compact( 'productos', 'marcas', 'categorias_filtro', 'rangos', 'request'));
    }


}
