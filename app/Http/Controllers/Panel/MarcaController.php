<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use App\Marca;
use App\Categoria;

class MarcaController extends Controller
{

  public function __construct( Marca $marcas, Categoria $categorias)
  {
    $this->middleware('auth');
    $this->marcas = $marcas;
    $this->categorias = $categorias;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $marcas = $this->marcas->orderBy('orden', 'desc')->get();

      return view('panel.marca.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Marca $marca)
    {
      $orden_maximo = $this->marcas->get()->count()+1;
      $categorias=$this->categorias->getPadresConHijos();
      return view('panel.marca.form', compact('marca', 'orden_maximo', 'categorias'));
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
      $request['destacado']=$request['destacado']?'1':'0';
      $marca = $this->marcas->create($request->only('titulo', 'orden', 'web', 'destacado', 'id_categoria') + ['user_id'=> \Auth::user()->id]);
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $marca->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $marca->fill(['banner' => $imageName])->save();
      }

        Session::flash('mensaje', 'La marca '.$marca->titulo.' ha sido creada correctamente');
        return redirect(route('marca.index'))->with('status', 'La marca ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $marca = $this->marcas->findOrFail($id);
      $orden_maximo = $this->marcas->get()->count()+1;
      $categorias=$this->categorias->getPadresConHijos();
      return view('panel.marca.form', compact('marca', 'orden_maximo','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'titulo'=> 'required|max:255'
      ]);
      $marca = $this->marcas->findOrFail($id);
      $request['destacado']=$request['destacado']?'1':'0';
      $marca->fill($request->only('titulo', 'orden', 'web' , 'destacado', 'id_categoria'))->save();
      if($request->hasFile('logo')) {
          $imageName = str_slug($request->titulo).'-l-'.time() . '.' .$request->file('logo')->getClientOriginalExtension();
          $request->file('logo')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $marca->fill(['logo' => $imageName])->save();
      }
      if($request->hasFile('banner')) {
          $imageName = str_slug($request->titulo).'-b-'.time() . '.' .$request->file('banner')->getClientOriginalExtension();
          $request->file('banner')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $marca->fill(['banner' => $imageName])->save();
      }
      Session::flash('mensaje', 'La marca  '.$marca->titulo.' ha sido actualizada correctamente');

      return redirect(route('marca.edit', $marca->id))->with('status', 'La marca ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $marca = $this->marcas->findOrFail($id);
      $marca->delete();
      Session::flash('mensaje', 'La Marca '. $marca->titulo.' ha sido eliminada');
      return redirect(route('marca.index'));
    }
}
