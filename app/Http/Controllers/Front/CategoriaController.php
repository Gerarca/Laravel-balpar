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


class CategoriaController extends Controller
{
    public function __construct( Categoria $categorias, Producto $productos)
    {
        $this->categorias = $categorias;
        $this->productos = $productos;
    }

    public function ver($id, $titulo, Request $request)
    {
        $categoria = $this->categorias->findOrFail($id);
        $categorias_aux_ids=$categoria->getHijosCompleto();
        $array_categorias=array();
        foreach ($categorias_aux_ids as $aux) {
            array_push($array_categorias, $aux->id);
        }
        array_push($array_categorias, $categoria->id);
        $categorias_aux=$categoria->getPadres();

        $marcas=Marca::orderBy('orden', 'asc')->get();
        $categorias_filtro=Categoria::where('cod_padre',NULL)->orderBy('orden', 'asc')->get();
        $etiquetas_filtro=Etiqueta::whereHas('productos', function ($query) use($array_categorias)  {
            $query->whereIn('categoria_id', $array_categorias);
        })->get();
        $tamanos_filtro=Tamano::whereHas('productos', function ($query) use($array_categorias)  {
            $query->whereIn('categoria_id', $array_categorias);
        })->orderByRaw('CAST(tamanos.titulo AS DECIMAL(10, 2)) ASC')
            ->orderByRaw('FIELD(tamanos.titulo, "P", "M", "G", "GG", "XG", "XX", "U")')->get();
        $colores_filtro=Color::whereHas('productos', function ($query) use($array_categorias)  {
            $query->whereIn('categoria_id', $array_categorias);
        })->get();

        $precio_retail_maximo =Producto::whereIn('categoria_id', $array_categorias)->where('visible', 1)->max('precio_retail');
        $precio_retail_minimo =Producto::whereIn('categoria_id', $array_categorias)->where('visible', 1)->min('precio_retail');
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

        $productos = $this->productos->whereIn('categoria_id', $array_categorias)->where('visible', 1)->where(
          function ($query) use($request, $rangos) {
              if (isset($request->cat) && sizeof($request->cat)>=1) {
                $query->whereIn('categoria_id',$request->cat);
              }
              if (isset($request->etiquetas) && sizeof($request->etiquetas)>=1) {
                $query->whereHas('etiquetas', function($query_sub) use ($request) {
                  $query_sub->whereIn('etiquetas.id', $request->etiquetas);
                });
              }
              if (isset($request->tamanos) && sizeof($request->tamanos)>=1) {
                $query->whereHas('tamanos', function($query_sub) use ($request) {
                  $query_sub->whereIn('tamanos.id', $request->tamanos);
                });
              }
              if (isset($request->colores) && sizeof($request->colores)>=1) {
                $query->whereHas('colores', function($query_sub) use ($request) {
                  $query_sub->whereIn('colores.id', $request->colores);
                });
              }
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
        return view('front.categoria.ver', compact('categoria', 'productos', 'categorias_aux', 'marcas', 'categorias_filtro', 'rangos', 'etiquetas_filtro', 'request', 'tamanos_filtro', 'colores_filtro'));
    }


}
