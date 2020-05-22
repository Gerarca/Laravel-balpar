<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\CategoriaTrabajo;
use DB;
use Session;

class CategoriaTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.categoria_trabajos.index', ['categorias' => CategoriaTrabajo::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoriaTrabajo $categoria_trabajo)
    {
        return view('panel.categoria_trabajos.form', compact('categoria_trabajo'));
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
            'categoria'=> 'required|max:255'
        ]);
        $categoria_trabajo = CategoriaTrabajo::create($request->only('categoria'));

        Session::flash('mensaje', 'La categoria '.$categoria_trabajo->categoria.' ha sido creada correctamente');
        return redirect(route('categoria_trabajos.index'));
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
    public function edit(CategoriaTrabajo $categoria_trabajo)
    {
        return view('panel.categoria_trabajos.form', compact('categoria_trabajo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaTrabajo $categoria_trabajo)
    {
        request()->validate([
            'categoria'=> 'required|max:255'
        ]);

        $categoria_trabajo->fill($request->only('categoria'))->save();

        Session::flash('mensaje', 'La categoría  '.$categoria_trabajo->categoria.' ha sido actualizada correctamente.');
        return redirect(route('categoria_trabajos.edit', $categoria_trabajo->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaTrabajo $categoria_trabajo)
    {
        $categoria_trabajo->delete();
        Session::flash('mensaje', 'La Categoria '. $categoria_trabajo->categoria.' ha sido eliminada.');
        return redirect(route('categoria_trabajos.index'));
    }
}
