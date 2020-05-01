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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.etiquetas.index', ['etiquetas' => Etiqueta::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Etiqueta $etiqueta)
    {
        return view('panel.etiquetas.form', compact('etiqueta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Etiqueta::create(request()->validate(['nombre' => 'required|max:255']));

        Session::flash('mensaje', 'La etiqueta ' . $request->nombre . ' ha sido creada correctamente');
        return redirect(route('etiquetas.index'));
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
    public function edit(Etiqueta $etiqueta)
    {
        return view('panel.etiquetas.form', compact('etiqueta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etiqueta $etiqueta)
    {
        $etiqueta->fill($request->only('nombre'))->save();

        Session::flash('mensaje', 'La etiqueta ' . $etiqueta->nombre . ' ha sido actualizado correctamente');
        return redirect(route('etiquetas.edit', $etiqueta->id))->with('status', 'La etiqueta se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();
        Session::flash('mensaje', 'La etiqueta ' . $etiqueta->nombre . ' ha sido eliminado');
        return redirect(route('etiquetas.index'));
    }
}
