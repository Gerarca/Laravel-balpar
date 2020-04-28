<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use App\Color;

class ColorController extends Controller
{

  public function __construct( Color $colores)
  {
    $this->middleware('auth');
    $this->colores = $colores;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $colores = $this->colores->orderBy('orden', 'desc')->get();

      return view('panel.color.index', compact('colores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Color $color)
    {
      $orden_maximo = $this->colores->get()->count()+1;
      return view('panel.color.form', compact('color', 'orden_maximo'));
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
      $color = $this->colores->create($request->only('titulo', 'orden') + ['user_id'=> \Auth::user()->id]);
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $color->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $color->fill(['banner' => $imageName])->save();
      }

        Session::flash('mensaje', 'La color '.$color->titulo.' ha sido creada correctamente');
        return redirect(route('color.index'))->with('status', 'La color ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $color = $this->colores->findOrFail($id);
      $orden_maximo = $this->colores->get()->count()+1;
      return view('panel.color.form', compact('color', 'orden_maximo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'titulo'=> 'required|max:255'
      ]);
      $color = $this->colores->findOrFail($id);
      $color->fill($request->only('titulo', 'orden'))->save();
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $color->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $color->fill(['banner' => $imageName])->save();
      }
      Session::flash('mensaje', 'La color  '.$color->titulo.' ha sido actualizada correctamente');

      return redirect(route('color.edit', $color->id))->with('status', 'La color ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $color = $this->colores->findOrFail($id);
      $color->delete();
      Session::flash('mensaje', 'La Color '. $color->titulo.' ha sido eliminada');
      return redirect(route('color.index'));
    }
}
