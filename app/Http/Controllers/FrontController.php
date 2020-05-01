<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\DatosDinamico;
use App\Testimonio;
use App\Marca;
use App\Uso;

class FrontController extends Controller
{
    public function index(){
        $banners = Banner::where('visible', '=', 1)->orderBy('orden')->get();
        $dato_dinamico = DatosDinamico::first();
        $testimonios = Testimonio::where('visible', '=', 1)->orderBy('id', 'desc')->get();
        $marcas = Marca::all();
		return view('front.index', compact('banners', 'dato_dinamico', 'testimonios', 'marcas'));
	}
    public function contacto(){
        $testimonios = Testimonio::where('visible', '=', 1)->orderBy('id', 'desc')->get();
		return view('front.contacto', compact('testimonios'));
	}
    public function catalogo(){
        $marcas = Marca::orderBy('nombre')->get();
        $usos = Uso::orderBy('uso')->get();
		return view('front.catalogo', compact('marcas', 'usos'));
	}
    public function producto(){
		return view('front.producto');
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
