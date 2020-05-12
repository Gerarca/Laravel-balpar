<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Uso;
use App\Categoria;
use Session;

class UsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.usos.index', ['usos' => Uso::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Uso $uso)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.usos.form', compact('uso', 'categorias'));
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
            'uso' => 'required|max:255'
        ]);

        $uso = Uso::create($request->only('categoria_id', 'uso'));

        Session::flash('mensaje', 'El uso '.$uso->uso.' ha sido creado correctamente');
        return redirect(route('usos.index'));
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
    public function edit(Uso $uso)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.usos.form', compact('uso', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Uso $uso)
    {
        request()->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'uso' => 'required|max:255'
        ]);

        $uso->fill($request->only('categoria_id', 'uso'))->save();

        Session::flash('mensaje', 'El uso '.$uso->uso.' ha sido actualizado correctamente');
        return redirect(route('usos.edit', $uso->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uso $uso)
    {
        $uso->delete();
        Session::flash('mensaje', 'El uso '.$uso->uso.' ha sido eliminado');
        return redirect(route('usos.index'));
    }
}
