<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pedido;
use App\PedidoDetalle;
use App\User;

class PanelController extends Controller
{
  public function __construct(Pedido $pedidos, User $usuarios)
  {
    $this->middleware('auth');
    // $this->pedidos=$pedidos;
    // $this->usuarios=$usuarios;
  }

    public function index()
    {
      // $total_mes=$this->pedidos->where('estado',2)->where('created_at', '>=', Carbon::now()->startOfMonth())->sum('monto_total');
      // $cantidad_mes=PedidoDetalle::where('estado',2)->where('created_at', '>=', Carbon::now()->startOfMonth())->sum('cantidad');
      // $total_ano=$this->pedidos->where('estado',2)->where('created_at', '>=', Carbon::now()->startOfYear())->sum('monto_total');
      // $cantidad_ano=PedidoDetalle::where('estado',2)->where('created_at', '>=', Carbon::now()->startOfYear())->sum('cantidad');

      $total_mes = '10000000';
      $cantidad_mes = 300;
      $total_ano = '123000000';
      $cantidad_ano = 1580;

    	return view('panel.index', compact('total_mes', 'cantidad_mes', 'total_ano', 'cantidad_ano'));
    }
}
