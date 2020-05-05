<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Banner;
use App\DatosDinamico;
use App\Testimonio;
use App\Producto;
use App\Categoria;
use App\Marca;
use App\Uso;
use App\Rubro;
use App\Etiqueta;
use App\Pedido;
use App\PedidoDetalle;
use Str;

class FrontController extends Controller
{
    public function index(){
        $banners = Banner::where('visible', '=', 1)->orderBy('orden')->get();
        $productos_comerciales = Producto::where('visible', 1)->where('destacado_comercial', 1)->orderBy('id', 'desc')->limit(5)->get();
        $productos_industriales = Producto::where('visible', 1)->where('destacado_industrial', 1)->orderBy('id', 'desc')->limit(5)->get();
        $testimonios = Testimonio::where('visible', '=', 1)->orderBy('id', 'desc')->get();
        $marcas = Marca::all();
        $dato_dinamico = DatosDinamico::first();
		return view('front.index', compact('banners', 'productos_comerciales', 'productos_industriales', 'dato_dinamico', 'testimonios', 'marcas'));
	}
    public function contacto(){
        $testimonios = Testimonio::where('visible', '=', 1)->orderBy('id', 'desc')->get();
		return view('front.contacto', compact('testimonios'));
	}
    public function catalogo_categoria(Categoria $categoria){
        $productos = $categoria->productos;
        $etiquetas = Etiqueta::orderBy('nombre')->get();
		return view('front.catalogo', compact('categoria', 'productos', 'etiquetas'));
	}
    public function catalogo_marca(Marca $marca){
        $categoria = $marca->categoria;
        $productos = $marca->productos;
        $etiquetas = Etiqueta::orderBy('nombre')->get();
		return view('front.catalogo', compact('categoria', 'marca', 'productos', 'etiquetas'));
	}
    public function catalogo_uso(Uso $uso){
        $categoria = $uso->categoria;
        $productos = $uso->productos;
        $etiquetas = Etiqueta::orderBy('nombre')->get();
		return view('front.catalogo', compact('categoria', 'uso', 'productos', 'etiquetas'));
	}
    public function catalogo_rubro(Rubro $rubro){
        $categoria = $rubro->categoria;
        $productos = $rubro->productos;
        $etiquetas = Etiqueta::orderBy('nombre')->get();
		return view('front.catalogo', compact('categoria', 'rubro', 'productos', 'etiquetas'));
	}
    public function catalogo_etiqueta(Etiqueta $etiqueta){
        $productos = $etiqueta->productos;
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Etiqueta', 'titulo' => $etiqueta->nombre];
		return view('front.catalogo_filtro', compact('productos', 'etiqueta', 'etiquetas', 'asunto'));
	}
    public function buscar_catalogo(Request $request){
        $productos = Producto::where('nombre', 'LIKE', '%' . request('search_product') . '%')->get();
        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Búsqueda', 'titulo' => request('search_product')];
        return view('front.catalogo_filtro', compact('productos', 'etiqueta', 'etiquetas', 'asunto'));
    }
    public function catalogo_destacado(Request $request){

        if($request->destacado == 1){
            $productos = Producto::where('destacado_comercial', 1)->orderBy('id', 'desc')->get();
            $titulo = 'Destacados Comercial';
        } else {
            $titulo = 'Destacados Industrial';
            $productos = Producto::where('destacado_industrial', 1)->orderBy('id', 'desc')->get();
        }

        $etiquetas = Etiqueta::orderBy('nombre')->get();
        $asunto = ['asunto' => 'Destacado', 'titulo' => $titulo];
        return view('front.catalogo_filtro', compact('productos', 'etiquetas', 'asunto'));
    }
    public function producto(Producto $producto){
		return view('front.producto', compact('producto'));
	}
    public function presupuesto(){
        $actual_cookie = Cookie::get('productos') ?? serialize([]);
        $carrito_detalles = unserialize($actual_cookie);
        $total = 0;
        $envio = 0;
        $carrito_detalles = array_map(function ($detalle) {
            $producto = Producto::where('cod_articulo', $detalle['cod_articulo'])->first();
            $detalle['id'] = $producto->id;
            $detalle['nombre'] = $producto->nombre;
            $detalle['imagen'] = asset('storage/productos/' . $producto->imagen);
            $detalle['url'] = route('front.producto', [$producto->id, Str::slug($producto->nombre)]);
            return $detalle;
        }, $carrito_detalles);

        // foreach ($carrito_detalles as $pos => $detalle) {
        //     $total+=$detalle['precio']*$detalle['cantidad'];
        // }
        // $ciudades = Ciudad::where('visible',1)->orderBy('orden', 'desc')->get();
		return view('front.presupuesto', compact('carrito_detalles', 'envio'));
	}
    public function nosotros(){
		return view('front.nosotros');
	}
    public function servicio_tecnico(){
		return view('front.servicio_tecnico');
	}
    public function cargar_testimonio(Request $request)
    {
        request()->validate([
            'nombre' => 'required|max:255',
            'testimonio' => 'required'
        ]);

        Testimonio::create($request->only('nombre', 'testimonio'));
        return back()->with('status', 'Gracias por dejar tu testimonio!');
    }

    public function carritoFinalizar(Request $request){
        request()->validate([
            'nombre'=> 'required|max:255',
            'telefono'=> 'required|max:255',
            'email'=> 'required|email|max:255',
            'empresa'=> 'max:255'
        ]);

        $actual_cookie = Cookie::get('productos') ?? serialize([]);
        $carrito_detalles = unserialize($actual_cookie);
        $subtotal=0;
        $envio=0;
        $carrito_detalles = array_map(function ($detalle) {
            $producto = Producto::where('cod_articulo', $detalle['cod_articulo'])->first();
            $detalle['titulo'] = $producto->nombre;
            $detalle['imagen'] = asset('storage/productos/' . $producto->imagen);
            $detalle['url'] = route('front.producto', [$producto->id, Str::slug($producto->nombre)]);
            $detalle['producto'] = $producto;
            return $detalle;
        }, $carrito_detalles);
        // foreach ($carrito_detalles as $pos => $detalle) {
        //     $subtotal+=$detalle['precio']*$detalle['cantidad'];
        // }
        // $ciudad=Ciudad::where('id',$request['ciudad'])->where('visible', 1)->first();
        // if ($ciudad==NULL) {
        //     return back()->withErrors('No se encuentra la ciudad especificada o esta desactivada ');
        // }
        // $envio=$ciudad->delivery;
        // $descuento=0;

        if (sizeof($carrito_detalles)>=1) {
            $pedido=Pedido::create([
                'nombre'=>$request['nombre'],
                'telefono'=>$request['telefono'],
                'email'=>$request['email'],
                'empresa'=>$request['empresa'],
                'mensaje'=>$request['mensaje']
            ]);
            if ($pedido==NULL) {
                return back()->withErrors('Ocurrió un error, favor volver a intentar en unos minutos');
            }else {
                foreach ($carrito_detalles as $pos => $detalle) {
                    PedidoDetalle::create([
                        'pedido_id'=>$pedido->id,
                        'cod_articulo'=>$detalle['cod_articulo'],
                        'cantidad'=>$detalle['cantidad']
                    ]);
                }
                $pedido->finalizar();
                Cookie::queue(Cookie::forget('productos'));
                return redirect()->route('front.presupuesto')->with('status', 'Su pedido de presupuesto se ha realizado con exito.');

            }
        }else {
            return back()->withErrors('El carrito se encuentra vacio');
        }

    }

    public function carritoResumen(Request $request, $id_md5){
        $pedido = Pedido::where('estado',1)->where(DB::raw('md5(id)'),$id_md5)->first();
        if ($pedido==NULL) {
            return back()->withErrors('No se encuentra el pedido definido');
        }else {
            return view('front.resumen', compact('pedido'));
        }
    }

}
