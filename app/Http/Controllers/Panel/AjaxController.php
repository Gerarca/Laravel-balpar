<?php

namespace App\Http\Controllers\Panel;

use App\BlogFoto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Marca;
use App\Uso;
use App\Rubro;

class AjaxController extends Controller
{
    // public function marcas(Request $request)
    // {
    //     $marcas = Marca::where('categoria_id', '=', $request->valor)->get();
    //     $valores = [];
    //     foreach ($marcas as $marca) {
    //         $valores[] = array(
    //             'id' => $marca->id,
    //             'nombre' => $marca->nombre
    //         );
    //     }
    //     return $valores;
    // }

    public function usos(Request $request)
    {
        $usos = Uso::where('categoria_id', '=', $request->valor)->get();
        $valores = [];
        foreach ($usos as $uso) {
            $valores[] = array(
                'id' => $uso->id,
                'nombre' => $uso->uso
            );
        }
        return $valores;
    }

    public function rubros(Request $request)
    {
        $rubros = Rubro::where('categoria_id', '=', $request->valor)->get();
        $valores = [];
        foreach ($rubros as $rubro) {
            $valores[] = array(
                'id' => $rubro->id,
                'nombre' => $rubro->rubro
            );
        }
        return $valores;
    }

    public function eliminarImagen(Request $request)
    {
        BlogFoto::destroy($request->idImagen);
    }
}
