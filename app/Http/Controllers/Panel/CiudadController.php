<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;

use App\User;
use App\Role;
use App\Ciudad;


class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('panel.ciudad.index', ['ciudades' => Ciudad::orderBy('orden', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ciudad $ciudad)
    {
        $orden_maximo = Ciudad::all()->count() + 1;
        return view('panel.ciudad.form', compact('ciudad', 'orden_maximo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'ciudad'=> 'required|max:255',
            'delivery'=> 'required',
        ]);

        $orden_actual = Ciudad::where('orden', '>=', $request['orden']);

        if($orden_actual->exists()){
            $orden_actual->increment('orden');
        }

        $request['visible'] = $request['visible'] ? '1' : '0';
        $ciudad = Ciudad::create($request->only('ciudad', 'delivery', 'orden', 'visible'));

        Session::flash('mensaje', 'La ciudad '.$ciudad->ciudad.' ha sido creada correctamente');
        return redirect(route('ciudad.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function show(Ciudad $ciudad)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudad $ciudad)
    {
        $orden_maximo = Ciudad::all()->count();
        return view('panel.ciudad.form', compact('ciudad', 'orden_maximo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciudad $ciudad)
    {
        request()->validate([
            'ciudad'=> 'required|max:255',
            'delivery'=> 'required',
        ]);

        if(request()->orden != $ciudad->orden){

            $orden_viejo = Ciudad::where('orden', $request["orden"]);
            $orden_viejo->update(['orden' => $ciudad->orden]);
            $ciudad->orden = request('orden');
            $ciudad->save();
        }

        $request['visible'] = $request['visible'] ? '1' : '0';
        $ciudad->fill($request->only('ciudad', 'delivery', 'orden', 'visible'))->save();

        Session::flash('mensaje', 'La ciudad  '.$ciudad->ciudad.' ha sido actualizada correctamente');
        return redirect(route('ciudad.edit', $ciudad->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudad $ciudad)
    {
        $orden_actual = Ciudad::where('orden', '>=', $ciudad['orden']);

        if($orden_actual->exists()){
            $orden_actual->decrement('orden');
        }

        $ciudad->delete();
        Session::flash('mensaje', 'El Ciudad '. $ciudad->ciudad.' ha sido eliminada');
        return redirect(route('ciudad.index'));
    }
}
