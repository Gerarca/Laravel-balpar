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
use App\SolicitudTarjeta;


class SolicitudTarjetaController extends Controller
{

    public function __construct(User $users, Role $roles, SolicitudTarjeta $solicitudes)
    {
      $this->middleware('auth');
      $this->users = $users;
      $this->roles = $roles;
      $this->solicitudes = $solicitudes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $solicitudes = $this->solicitudes->get();

      return view('panel.solicitudtarjeta.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SolicitudTarjeta $solicitud)
    {
        return view('panel.solicitudtarjeta.form', compact('solicitud'));
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
        'solicitud'=> 'required|max:255',
        'delivery'=> 'required',
      ]);


      $request['estado']=$request['estado']?'1':'0';
      $solicitud = $this->solicitudes->create($request->only('solicitud', 'delivery', 'estado') + ['user_id'=> \Auth::user()->id]);

      Session::flash('mensaje', 'La solicitud de'.$solicitud->nombre.' ha sido creada correctamente');
        return redirect(route('solicitudtarjeta.index'))->with('status', 'La solicitud ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SolicitudTarjeta  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(SolicitudTarjeta $solicitud)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SolicitudTarjeta  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = $this->solicitudes->findOrFail($id);
        return view('panel.solicitudtarjeta.form', compact('solicitud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SolicitudTarjeta  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'estado'=> 'required',
      ]);
      $request['estado']=$request['estado']?'1':'0';
      $solicitud = $this->solicitudes->findOrFail($id);
      $solicitud->fill($request->only('estado'))->save();



      Session::flash('mensaje', 'La solicitud de '.$solicitud->nombre.' ha sido actualizada correctamente');

      return redirect(route('solicitudtarjeta.edit', $solicitud->id))->with('status', 'La solicitud ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SolicitudTarjeta  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $solicitud = $this->solicitudes->findOrFail($id);

      $solicitud->delete();
      Session::flash('mensaje', ' La solicitud de  '. $solicitud->nombre.' ha sido eliminada');
      return redirect(route('solicitudtarjeta.index'));
    }
}
