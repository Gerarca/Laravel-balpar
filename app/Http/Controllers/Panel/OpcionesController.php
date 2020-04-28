<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use Image;

use App\Opcion;

class OpcionesController extends Controller
{
    //
    public function __construct(Opcion $opciones)
    {
        $this->middleware('auth');
        $this->opciones = $opciones;
        $this->groups = config('cms.options');
    }

    public function  index()
    {
      // dd($this->groups);
    	foreach($this->groups as $key => $group) {
          $object[] = (object)[
            'key' => $key,
            'name' => $group,
            'options' => $options = DB::table('opciones')
              ->select('*')
              ->where('group', $key)
              ->orderBy('id')
              ->get()
          ];
        }

    	return view('panel.opciones.index', compact('object'));
    }

    public function store(Request $request)
    {

      // return $request;
        $images = DB::table('opciones')->where('type', 'imagen')->pluck('name')->toArray();
        $fechas = DB::table('opciones')->where('type', 'date')->pluck('name')->toArray();

        foreach($request->except('_token') as $key => $value) {
          if(in_array($key, $images)) {


          }elseif (in_array($key, $fechas)) {
            $exploid_vencimiento=explode('/', $value);
            $value=$exploid_vencimiento[2].'-'.$exploid_vencimiento[1].'-'.$exploid_vencimiento[0];
            $value=date('Y-m-d',strtotime($value));
            DB::table('opciones')
              ->where('name', $key)
              ->update(['value' => $value]);

          } else {
            DB::table('opciones')
              ->where('name', $key)
              ->update(['value' => $value]);
          }
        }


        foreach ($images as $pos => $image_pos) {
          if($request->hasFile($image_pos)) {
              $imageName = str_slug($image_pos).'-'.time() . '.' .$request->file($image_pos)->getClientOriginalExtension();
              $request->file($image_pos)->move(base_path() . '/public/uploads/', $imageName);
              DB::table('opciones')
                ->where('name', $image_pos)
                ->update(['value' => $imageName]);

          }
        }

        // foreach ($variable as $key => $value) {
        //   // code...
        // }

        return redirect(route('panel.opciones.index'))->with('status', 'Las opciones han sido actualizadas');
    }
}
