<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;

use App\Pedido;
use App\PedidoDetalle;

use App\Exports\PedidosExport;
use Maatwebsite\Excel\Facades\Excel;

class PedidosController extends Controller
{
    //
    public function __construct(Pedido $pedidos, PedidoDetalle $pedidoDetalle)
    {
        $this->middleware('auth');
        $this->pedidos = $pedidos;
        $this->pedidosDetalles = $pedidoDetalle;
    }

    public function  index()
    {
      $pedidos=$this->pedidos->whereNotIn('estado',['0'])->get();

    	return view('panel.pedidos.index', compact('pedidos'));
    }
    public function  export()
    {
        return Excel::download(new PedidosExport, 'pedidos.xlsx');
     //  return response(view('exports.pedidos', [
     //     'pedidos' => Pedido::where('estado','<>',0)->get()
     // ]))
     // ->header('Content-Type', 'application/vnd.ms-excel;')
     // ->header('Content-Disposition', 'attachment; filename=pedidos.xls')
     // ->header('Expires', '0');
    }

    public function edit($id)
    {
      $pedido = $this->pedidos->findOrFail($id);

      return view('panel.pedidos.form', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        request()->validate([
            'estado'=> 'required'
        ]);

        $pedido->fill($request->only('estado'))->save();
        Session::flash('mensaje', 'El pedido de '. $request->nombre .' se ha realizado.');
        return redirect(route('pedidos.index'));

    }


}
