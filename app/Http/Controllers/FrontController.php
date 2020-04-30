<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\DatosDinamico;

class FrontController extends Controller
{
    public function index(){
        $banners = Banner::where('visible', '=', 1)->orderBy('orden')->get();
        $dato_dinamico = DatosDinamico::first();
		return view('front.index', compact('banners', 'dato_dinamico'));
	}
    public function contacto(){
		return view('front.contacto');
	}
    public function catalogo(){
		return view('front.catalogo');
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
}
