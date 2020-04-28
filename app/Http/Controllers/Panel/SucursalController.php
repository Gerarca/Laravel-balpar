<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use App\Sucursal;

class SucursalController extends Controller
{

  public function __construct( Sucursal $sucursales)
  {
    $this->middleware('auth');
    $this->sucursales = $sucursales;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sucursales = $this->sucursales->orderBy('orden', 'desc')->get();

      return view('panel.sucursal.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sucursal $sucursal)
    {
      $orden_maximo = $this->sucursales->get()->count()+1;
      return view('panel.sucursal.form', compact('sucursal', 'orden_maximo'));
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
        'titulo'=> 'required|max:255',
      ]);
      $sucursal = $this->sucursales->create($request->only('titulo', 'orden', 'direccion', 'telefono', 'mail', 'ubicacion', 'iframe') + ['user_id'=> \Auth::user()->id]);
      if($request->hasFile('imagen')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(450, 450, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $sucursal->fill(['imagen' => $imageName])->save();
      }


        Session::flash('mensaje', 'La sucursal '.$sucursal->titulo.' ha sido creada correctamente');
        return redirect(route('sucursal.index'))->with('status', 'La sucursal ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $sucursal = $this->sucursales->findOrFail($id);
      $orden_maximo = $this->sucursales->get()->count()+1;
      return view('panel.sucursal.form', compact('sucursal', 'orden_maximo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'titulo'=> 'required|max:255'
      ]);
      $sucursal = $this->sucursales->findOrFail($id);
      $sucursal->fill($request->only('titulo', 'orden', 'direccion', 'telefono', 'mail', 'ubicacion', 'iframe'))->save();
      if($request->hasFile('imagen')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(450, 450, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $sucursal->fill(['imagen' => $imageName])->save();
      }

      Session::flash('mensaje', 'La sucursal  '.$sucursal->titulo.' ha sido actualizada correctamente');

      return redirect(route('sucursal.edit', $sucursal->id))->with('status', 'La sucursal ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $sucursal = $this->sucursales->findOrFail($id);
      $sucursal->delete();
      Session::flash('mensaje', 'La Sucursal '. $sucursal->titulo.' ha sido eliminada');
      return redirect(route('sucursal.index'));
    }
}
