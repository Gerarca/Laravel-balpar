<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Catalogo;
use App\CategoriaCatalogo;
use Session;
use Image;
use Str;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.catalogos.index', ['catalogos' => Catalogo::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Catalogo $catalogo)
    {
        $categorias = CategoriaCatalogo::orderBy('nombre')->get();
        return view('panel.catalogos.form', compact('catalogo', 'categorias'));
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
            'categoria_catalogo_id' => 'required',
            'nombre' => 'required|max:255',
            'imagen' => 'required|image',
            'archivo' => 'required'
        ]);

        $destino = base_path() . '/public/uploads/';
        $imageName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
        $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);

        $archivoName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('archivo')->getClientOriginalExtension();
        $request->file('archivo')->move(base_path() . '/public/uploads/', $archivoName);
        Image::make($destino . $imageName)->resize(400, null, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        })->encode('jpg', 70)->save($destino . $imageName);

        Catalogo::create($request->only('categoria_catalogo_id', 'nombre') + ['imagen' => $imageName] + ['archivo' => $archivoName]);

        Session::flash('mensaje', 'El catálogo ' . $request->nombre . ' ha sido creado correctamente');
        return redirect(route('catalogos.index'));
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
    public function edit(Catalogo $catalogo)
    {
        $categorias = CategoriaCatalogo::orderBy('nombre')->get();
        return view('panel.catalogos.form', compact('catalogo', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalogo $catalogo)
    {
        request()->validate([
            'categoria_catalogo_id' => 'required',
            'nombre' => 'required|max:255',
            'imagen' => 'image',
        ]);
        $catalogo->fill($request->only('categoria_catalogo_id', 'nombre'))->save();

        if ($request->hasFile('imagen')) {
            $destino = base_path() . '/public/uploads/';
            $imageName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
            $catalogo->fill(['imagen' => $imageName])->save();
            Image::make($destino . $imageName)->resize(400, null, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 70)->save($destino . $imageName);
        }

        if ($request->hasFile('archivo')) {
            $archivoName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('archivo')->getClientOriginalExtension();
            $request->file('archivo')->move(base_path() . '/public/uploads/', $archivoName);
            $catalogo->fill(['archivo' => $archivoName])->save();
        }

        Session::flash('mensaje', 'El catálogo ' . $catalogo->nombre . ' ha sido actualizado correctamente');
        return redirect(route('catalogos.edit', $catalogo->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalogo $catalogo)
    {
        $catalogo->delete();
        Session::flash('mensaje', 'El catálogo ' . $catalogo->nombre . ' ha sido eliminado');
        return redirect(route('catalogos.index'));
    }
}
