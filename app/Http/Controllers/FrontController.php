<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\DatosDinamico;
use App\Testimonio;
use App\Producto;
use App\Categoria;
use App\Marca;
use App\Uso;
use App\Rubro;
use App\Etiqueta;

class FrontController extends Controller
{
    public function index(){
        $banners = Banner::where('visible', '=', 1)->orderBy('orden')->get();
        $productos_comerciales = Producto::where('destacado_comercial', 1)->orderBy('id', 'desc')->limit(5)->get();
        $productos_industriales = Producto::where('destacado_industrial', 1)->orderBy('id', 'desc')->limit(5)->get();
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
		return view('front.presupuesto');
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
}
