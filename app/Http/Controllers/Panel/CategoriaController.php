<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use App\Categoria;

class CategoriaController extends Controller
{

  public function __construct( Categoria $categorias)
  {
    $this->middleware('auth');
    $this->categorias = $categorias;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categorias = $this->categorias->orderBy('orden', 'desc')->get();

      return view('panel.categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Categoria $categoria)
     {
         // $orden_maximo = $this->categorias->get()->count()+1;
         $orden_maximo=10;
         $categorias=$this->categorias->getPadresConHijos();
         return view('panel.categoria.form', compact('categoria', 'orden_maximo', 'categorias'));
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
        'imagen'=> 'image'
      ]);
      $categoria = $this->categorias->create($request->only('titulo', 'cod_padre', 'orden') + ['user_id'=> \Auth::user()->id]);
      if($request->hasFile('imagen')) {
          $imageName = str_slug($request->titulo).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(800, 500, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $categoria->fill(['imagen' => $imageName])->save();
      }

        Session::flash('mensaje', 'La categoria '.$categoria->titulo.' ha sido creada correctamente');
        return redirect(route('categoria.index'))->with('status', 'La categoria ha sido creado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria, $id)
    {
      $categoria = $this->categorias->findOrFail($id);
      $categorias=$this->categorias->getPadresConHijos();
      // $orden_maximo = $this->categorias->get()->count()+1;
       $orden_maximo=10;
      return view('panel.categoria.form', compact('categoria', 'orden_maximo', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria, $id)
    {
      request()->validate([
        'titulo'=> 'required|max:255'
      ]);
      $categoria = $this->categorias->findOrFail($id);
      $categoria->fill($request->only('titulo', 'cod_padre', 'orden'))->save();
      if($request->hasFile('imagen')) {
          $imageName = str_slug($request->titulo).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit(800, 500, function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $categoria->fill(['imagen' => $imageName])->save();
      }
      Session::flash('mensaje', 'La categoria  '.$categoria->titulo.' ha sido actualizada correctamente');

      return redirect(route('categoria.edit', $categoria->id))->with('status', 'La categoria ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria, $id)
    {
      $categoria = $this->categorias->findOrFail($id);
      $cod_padre=$categoria->cod_padre;
      $categoria->where('cod_padre',$categoria->id)
      ->update(['cod_padre' => $cod_padre]);

      $categoria->delete();
      Session::flash('mensaje', 'La Categoria '. $categoria->titulo.' ha sido eliminada');
      return redirect(route('categoria.index'));
    }
}
