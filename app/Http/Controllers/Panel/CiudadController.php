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

    public function __construct(User $users, Role $roles, Ciudad $ciudades)
    {
      $this->middleware('auth');
      $this->users = $users;
      $this->roles = $roles;
      $this->ciudades = $ciudades;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ciudades = $this->ciudades->orderBy('orden', 'desc')->get();

      return view('panel.ciudad.index', compact('ciudades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ciudad $ciudad)
    {
        $orden_maximo = $this->ciudades->get()->count()+1;
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


      $request['visible']=$request['visible']?'1':'0';
      $ciudad = $this->ciudades->create($request->only('ciudad', 'delivery', 'orden', 'visible') + ['user_id'=> \Auth::user()->id]);

      Session::flash('mensaje', 'La ciudad '.$ciudad->ciudad.' ha sido creada correctamente');
        return redirect(route('ciudad.index'))->with('status', 'La ciudad ha sido creada');
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
    public function edit($id)
    {
        $ciudad = $this->ciudades->findOrFail($id);
        $orden_maximo = $this->ciudades->get()->count()+1;
        return view('panel.ciudad.form', compact('ciudad', 'orden_maximo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'ciudad'=> 'required|max:255',
        'delivery'=> 'required',
      ]);
      $request['visible']=$request['visible']?'1':'0';
      $ciudad = $this->ciudades->findOrFail($id);
      $ciudad->fill($request->only('ciudad', 'delivery', 'orden', 'visible'))->save();



      Session::flash('mensaje', 'La ciudad  '.$ciudad->ciudad.' ha sido actualizada correctamente');

      return redirect(route('ciudad.edit', $ciudad->id))->with('status', 'La ciudad ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $ciudad = $this->ciudades->findOrFail($id);

      $ciudad->delete();
      Session::flash('mensaje', 'El Ciudad '. $ciudad->ciudad.' ha sido eliminada');
      return redirect(route('ciudad.index'));
    }
}
