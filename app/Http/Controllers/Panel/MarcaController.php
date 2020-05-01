<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Session;
use Str;
use App\Marca;
use App\Categoria;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.marcas.index', ['marcas' => Marca::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Marca $marca)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.marcas.form', compact('marca', 'categorias'));
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
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|max:255',
            'imagen' => 'required|image'
        ]);

        //Portada
        $imagenName = Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
        $request->file('imagen')->move(base_path() . '/public/uploads/', $imagenName);

        $marca = Marca::create($request->only('categoria_id', 'nombre') + ['imagen' => $imagenName]);

        Session::flash('mensaje', 'La marca '.$marca->nombre.' ha sido creada correctamente');
        return redirect(route('marcas.index'));
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
    public function edit(Marca $marca)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.marcas.form', compact('marca', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        request()->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|max:255',
            'imagen' => 'image'
        ]);

        $marca->fill($request->only('categoria_id', 'nombre'))->save();

        //Portada
        if($request->hasFile('imagen')){
            $imagenName = Str::slug($request->nombre).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(base_path() . '/public/uploads/', $imagenName);
            $marca->fill(['imagen' => $imagenName])->save();
        }

        Session::flash('mensaje', 'La marca '.$marca->nombre.' ha sido actualizada correctamente');
        return redirect(route('marcas.edit', $marca->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();
        Session::flash('mensaje', 'La marca '. $marca->nombre.' ha sido eliminada');
        return redirect(route('marcas.index'));
    }
}
