<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use App\Tamano;

class TamanoController extends Controller
{

  public function __construct( Tamano $tamanos)
  {
    $this->middleware('auth');
    $this->tamanos = $tamanos;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tamanos = $this->tamanos->orderBy('orden', 'desc')->get();

      return view('panel.tamano.index', compact('tamanos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tamano $tamano)
    {
      $orden_maximo = $this->tamanos->get()->count()+1;
      return view('panel.tamano.form', compact('tamano', 'orden_maximo'));
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
        'logo'=> 'image',
        'banner'=> 'image'
      ]);
      $tamano = $this->tamanos->create($request->only('titulo', 'orden') + ['user_id'=> \Auth::user()->id]);
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $tamano->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $tamano->fill(['banner' => $imageName])->save();
      }

        Session::flash('mensaje', 'El tamaño '.$tamano->titulo.' ha sido creado correctamente');
        return redirect(route('tamano.index'))->with('status', 'El tamaño ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function show(Tamano $tamano)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $tamano = $this->tamanos->findOrFail($id);
      $orden_maximo = $this->tamanos->get()->count()+1;
      return view('panel.tamano.form', compact('tamano', 'orden_maximo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'titulo'=> 'required|max:255'
      ]);
      $tamano = $this->tamanos->findOrFail($id);
      $tamano->fill($request->only('titulo', 'orden'))->save();
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $tamano->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $tamano->fill(['banner' => $imageName])->save();
      }
      Session::flash('mensaje', 'El tamaño  '.$tamano->titulo.' ha sido actualizado correctamente');

      return redirect(route('tamano.edit', $tamano->id))->with('status', 'La tamaño ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $tamano = $this->tamanos->findOrFail($id);
      $tamano->delete();
      Session::flash('mensaje', 'El tamaño '. $tamano->titulo.' ha sido eliminado');
      return redirect(route('tamano.index'));
    }
}
