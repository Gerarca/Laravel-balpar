<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DatosDinamico;
use Session;

class DatosDinamicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.datos_dinamicos.index', ['dato_dinamico' => DatosDinamico::first()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(DatosDinamico $datos_dinamico)
    {
        return view('panel.datos_dinamicos.form', compact('datos_dinamico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatosDinamico $datos_dinamico)
    {
        request()->validate([
            'years' => 'required|integer',
            'clientes' => 'required|integer',
            'trabajos' => 'required|integer'
        ]);

        $datos_dinamico->fill($request->only('years', 'clientes', 'trabajos'))->save();
        Session::flash('mensaje', 'Los datos han sido actualizados correctamente.');
        return redirect(route('datos_dinamicos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
