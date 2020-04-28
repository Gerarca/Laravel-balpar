<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aex\AEX;
use App\bancard\Bancard;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Carrito;
use App\CarritoDetalle;
use \Cookie;
use App\presto\Presto;

class PanelAjaxController extends Controller
{
  public function __construct(Presto $presto, Producto $productos, Carrito $carritos, CarritoDetalle $carritos_detalles, AEX $aexApi, Bancard $bancard)
  {
    $this->carritos = $carritos;
    $this->productos = $productos;
    $this->carritos_detalles = $carritos_detalles;
    $this->aexApi = $aexApi;
    $this->bancard = $bancard;
    $this->presto = $presto;
  }


    public function delProd(Request $request)
    {
      $curent_user=Auth::user();
      if ($curent_user) {
        if (Auth::user()->hasRole('Administrador')) {
            $detalle=$this->carritos_detalles->where('id',$request['cod'])->first();
            if (isset($detalle->id)) {
              $detalle->delete();
              $detalle->carrito->recalcularTotal();
            }
          return response()->json(['success'=>'El producto fue eliminado de manera exitosa']);
        }else {
          return response()->json(['error'=>'El usuario no tiene permisos para realizar la acción.']);
        }
      }else {
        return response()->json(['error'=>'Sesión expirada, favor volver a intentar.']);

      }
    }



}
