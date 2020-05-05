<?php

namespace App\Http\Controllers\Ajax;

use App\Carrito;
use App\CarritoDetalle;
use App\Color;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Favorito;
use App\Tamano;
use App\Categoria;
use App\User;
use App\Opcion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CarritoController extends Controller
{
    public function addProducto(Request $request)
    {
        $request->validate([
            'cod_articulo' => [
                'required',
                Rule::exists('productos')->where('visible', true), // El producto existe y es visible
            ],
            'cantidad' => 'required|numeric|gt:0',
        ]);


            $actual_cookie = Cookie::get('productos') ?? serialize([]);
            $carrito_detalles = unserialize($actual_cookie);

            $stock = Producto::where('cod_articulo',$request->cod_articulo)->first()->stock;
            if ($stock < $request->cantidad) {
                return response()
                    ->json(['respuesta' => 'error', 'error' => 'No existe stock suficiente para agregar al carrito'], Response::HTTP_CONFLICT);
            }

            $existe = (bool)array_filter($carrito_detalles, function ($detalle) use ($request) {
                return $detalle['cod_articulo'] == $request->cod_articulo;
            });

            if ($existe) {
                foreach ($carrito_detalles as &$detalle) {
                    if ($detalle['cod_articulo'] == $request->cod_articulo ) {
                        $nueva_cantidad = $detalle['cantidad'] + $request->cantidad;
                        if ($stock < $nueva_cantidad) {
                            return response()
                                ->json(['respuesta' => 'error', 'error' => 'No existe stock suficiente para agregar al carrito'], Response::HTTP_CONFLICT);
                        } else {
                            $detalle['cantidad'] = (int)$nueva_cantidad;
                        }
                    }
                }
            } else {
                $carrito_detalles[] = [
                    'cod_articulo' => $request->cod_articulo,
                    'cantidad' => (int)$request->cantidad,
                ];
            }

            $new_cookie = Cookie::forever('productos', serialize($carrito_detalles));
            Cookie::queue($new_cookie);
            return response()->json(['success' => 'El producto fue agregado de manera exitosa']);

    }


    public function getProductos()
    {
        $actual_cookie = Cookie::get('productos') ?? serialize([]);
        $carrito_detalles = unserialize($actual_cookie);
        $carrito_detalles = array_map(function ($detalle) {
            $producto = Producto::where('cod_articulo', $detalle['cod_articulo'])->first();
            if ($producto==null) {
              return false;
            }
            $detalle['nombre'] = $producto->nombre;
            $detalle['imagen'] = asset('storage/productos/' . $producto->imagen);
            $detalle['url'] = route('front.producto', [$producto->id, Str::slug($producto->nombre)]);
            return $detalle;
        }, $carrito_detalles);

        return $carrito_detalles;
    }

    public function delProducto(Request $request)
    {
        $actual_cookie = Cookie::get('productos') ?? serialize([]);
        $carrito_detalles = unserialize($actual_cookie);
        $eliminar = array_first($carrito_detalles, function ($detalle) use ($request) {
            return
            $detalle['cod_articulo'] == $request->cod_articulo ;
        });

        foreach ($carrito_detalles as $key => $value) {
            if ($value === $eliminar) {
                unset($carrito_detalles[$key]);
            }
        }
        $carrito_detalles = array_values($carrito_detalles);

        $new_cookie = Cookie::forever('productos', serialize($carrito_detalles));
        Cookie::queue($new_cookie);
        return response()->json(['success' => 'El producto fue eliminado.']);
    }
    public function getDescuento(Request $request){

      if ($request->metodo=='Tarjeta TNA') {
        $descuento_tna = Opcion::where('name','descuento_tna')->first();
        $descuento_tna=($descuento_tna<>NULL)?$descuento_tna['value']:0;
        $desde_descuento_tna = Opcion::where('name','desde_descuento_tna')->first();
        $desde_descuento_tna=($desde_descuento_tna<>NULL)?$desde_descuento_tna['value']:0;
        $hasta_descuento_tna = Opcion::where('name','hasta_descuento_tna')->first();
        $hasta_descuento_tna=($hasta_descuento_tna<>NULL)?$hasta_descuento_tna['value']:0;

        if ($descuento_tna>0 && $desde_descuento_tna<=now()->toDateString() && $hasta_descuento_tna>=now()->toDateString()) {
          $actual_cookie = Cookie::get('productos') ?? serialize([]);
          $carrito_detalles = unserialize($actual_cookie);
          $carrito_detalles = array_map(function ($detalle) {
            $producto = Producto::query()->find($detalle['cod_articulo']);
            $detalle['producto'] = $producto;
            return $detalle;
          }, $carrito_detalles);
          $descuento=0;
          $array_categorias_ignorar=array();
          $categoria_padre_ignorar=Categoria::where('cod_origen','006')->where('cod_padre',NULL)->first();
          if ($categoria_padre_ignorar<>NULL) {
            array_push($array_categorias_ignorar, $categoria_padre_ignorar->id);
            foreach ($categoria_padre_ignorar->getHijosCompleto() as $pos => $hijo_ignorar) {
              array_push($array_categorias_ignorar, $hijo_ignorar->id);
              foreach ($hijo_ignorar->getHijosCompleto() as $pos2 => $nieto_ignorar) {
                array_push($array_categorias_ignorar, $nieto_ignorar->id);
              }
            }
          }

          foreach ($carrito_detalles as $pos => $detalle) {
            if (!in_array($detalle['producto']->categoria_id,$array_categorias_ignorar)) {
              $descuento+=floor(($detalle['producto']->getPrecio()*$descuento_tna)/100);
            }
          }

          return response()->json(['descuento'=>$descuento]);

        }else {
          return response()->json(['descuento'=>0]);
        }
      }else {
        return response()->json(['descuento'=>0]);
      }


    }

}
