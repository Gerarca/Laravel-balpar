<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use App\Etiqueta;

class EtiquetaController extends Controller
{

  public function __construct( Etiqueta $etiquetas)
  {
    $this->middleware('auth');
    $this->etiquetas = $etiquetas;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $etiquetas = $this->etiquetas->orderBy('orden', 'desc')->get();

      return view('panel.etiqueta.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Etiqueta $etiqueta)
    {
      $orden_maximo = $this->etiquetas->get()->count()+1;
      return view('panel.etiqueta.form', compact('etiqueta', 'orden_maximo'));
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
      $etiqueta = $this->etiquetas->create($request->only('titulo', 'orden') + ['user_id'=> \Auth::user()->id]);
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $etiqueta->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $etiqueta->fill(['banner' => $imageName])->save();
      }

        Session::flash('mensaje', 'La etiqueta '.$etiqueta->titulo.' ha sido creada correctamente');
        return redirect(route('etiqueta.index'))->with('status', 'La etiqueta ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function show(Etiqueta $etiqueta)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $etiqueta = $this->etiquetas->findOrFail($id);
      $orden_maximo = $this->etiquetas->get()->count()+1;
      return view('panel.etiqueta.form', compact('etiqueta', 'orden_maximo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'titulo'=> 'required|max:255'
      ]);
      $etiqueta = $this->etiquetas->findOrFail($id);
      $etiqueta->fill($request->only('titulo', 'orden'))->save();
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $etiqueta->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $etiqueta->fill(['banner' => $imageName])->save();
      }
      Session::flash('mensaje', 'La etiqueta  '.$etiqueta->titulo.' ha sido actualizada correctamente');

      return redirect(route('etiqueta.edit', $etiqueta->id))->with('status', 'La etiqueta ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $etiqueta = $this->etiquetas->findOrFail($id);
      $etiqueta->delete();
      Session::flash('mensaje', 'La Etiqueta '. $etiqueta->titulo.' ha sido eliminada');
      return redirect(route('etiqueta.index'));
    }
}
