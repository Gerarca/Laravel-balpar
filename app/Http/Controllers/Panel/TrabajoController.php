<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabajo;
use App\CategoriaTrabajo;
use Session;
use Str;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.trabajos.index', ['trabajos' => Trabajo::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Trabajo $trabajo)
    {
        $categorias = CategoriaTrabajo::orderBy('categoria')->get();
        return view('panel.trabajos.form', compact('trabajo', 'categorias'));
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
            'categoria_id' => 'required',
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|image'
        ]);

        $imageName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
        $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);

        Trabajo::create($request->only('categoria_id', 'nombre', 'descripcion') + ['imagen' => $imageName]);

        Session::flash('mensaje', 'El proyecto ' . $request->nombre . ' ha sido creado correctamente');
        return redirect(route('trabajos.index'));
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
    public function edit(Trabajo $trabajo)
    {
        $categorias = CategoriaTrabajo::orderBy('categoria')->get();
        return view('panel.trabajos.form', compact('trabajo', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trabajo $trabajo)
    {
        request()->validate([
            'categoria_id' => 'required',
            'nombre' => 'required|max:255',
            'descripcion' => 'required'
        ]);
        $trabajo->fill($request->only('categoria_id', 'nombre', 'descripcion'))->save();

        if ($request->hasFile('imagen')) {
            $imageName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
            $trabajo->fill(['imagen' => $imageName])->save();
        }

        Session::flash('mensaje', 'El proyecto ' . $trabajo->nombre . ' ha sido actualizado correctamente');
        return redirect(route('trabajos.edit', $trabajo->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajo $trabajo)
    {
        $trabajo->delete();
        Session::flash('mensaje', 'El proyecto ' . $trabajo->nombre . ' ha sido eliminado');
        return redirect(route('trabajos.index'));
    }
}
