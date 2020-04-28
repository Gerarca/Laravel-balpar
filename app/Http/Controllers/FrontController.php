<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
		return view('front.index');
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
