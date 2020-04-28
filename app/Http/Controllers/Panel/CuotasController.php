<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use App\CuotaProducto;
use App\Producto;

class CuotasController extends Controller
{
  	public function __construct()
  	{
    	$this->middleware('auth');
  	}

    public function index($cod_articulo)
    {
		$producto = Producto::findOrFail($cod_articulo);
      	return view('panel.cuotas.form', compact('producto'));
    }

	public function store(Request $request) {
		$cuota = CuotaProducto::create([
			'cod_articulo' => $request->cod_articulo,
			'cantidad_cuotas' => $request->numero_cuotas,
			'precio_cuotas' => $request->monto_cuotas,
			'codigo_cuota' => md5(date("d-m-Y")),
			'user_id' => \Auth::id()
		]);

		Session::flash('mensaje', 'Se ha añadido una nueva cuota al producto.');
		return redirect(route('panel.cuotas.index', $request->cod_articulo))->with('status', 'Se ha añadido una nueva cuota al producto.');
	}

	public function update(Request $request) {
		
	}
}
