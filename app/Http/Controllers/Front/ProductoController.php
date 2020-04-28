<?php


namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct( Producto $productos)
    {
        $this->productos = $productos;
    }

    public function ver($cod_articulo, $titulo)
    {

        $producto_actual = $this->productos->findOrFail($cod_articulo);
        $categorias_aux=$producto_actual->categoria->getPadres();
        $array_categorias=array();
        foreach ($categorias_aux as $aux) {
            array_push($array_categorias, $aux->id);
        }
        array_push($array_categorias, $producto_actual->categoria_id);
        $productos_relacionados=$this->productos->where('visible', '1')->whereIn('categoria_id', $array_categorias)->where('cod_articulo', '<>', $producto_actual->cod_articulo)->take(12)->get();
        $estilo_con=$this->productos->where('visible', '1')->where('cod_articulo', '<>', $producto_actual->cod_articulo)->inRandomOrder()->take(12)->get();

        return view('front.producto.ver', compact('producto_actual', 'categorias_aux', 'productos_relacionados', 'estilo_con'));
    }


}
