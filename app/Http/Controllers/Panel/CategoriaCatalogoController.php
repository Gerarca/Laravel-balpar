<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CategoriaCatalogo;
use Session;

class CategoriaCatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.categoria_catalogos.index', ['categoria_catalogos' => CategoriaCatalogo::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoriaCatalogo $categoria_catalogo)
    {
        return view('panel.categoria_catalogos.form', compact('categoria_catalogo'));
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
            'nombre'=> 'required|max:255'
        ]);
        $categoria_catalogo = CategoriaCatalogo::create($request->only('nombre'));

        Session::flash('mensaje', 'La categoria '.$categoria_catalogo->nombre.' ha sido creada correctamente');
        return redirect(route('categoria_catalogos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaCatalogo $categoria_catalogo)
    {
        return view('panel.categoria_catalogos.form', compact('categoria_catalogo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaCatalogo $categoria_catalogo)
    {
        request()->validate([
            'nombre'=> 'required|max:255'
        ]);

        $categoria_catalogo->fill($request->only('nombre'))->save();

        Session::flash('mensaje', 'La categoría  '.$categoria_catalogo->nombre.' ha sido actualizada correctamente.');
        return redirect(route('categoria_catalogos.edit', $categoria_catalogo->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaCatalogo $categoria_catalogo)
    {
        $categoria_catalogo->delete();
        Session::flash('mensaje', 'La Categoria '. $categoria_catalogo->nombre.' ha sido eliminada.');
        return redirect(route('categoria_catalogos.index'));
    }
}
