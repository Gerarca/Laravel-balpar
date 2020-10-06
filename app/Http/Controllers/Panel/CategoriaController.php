<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Image;
use DB;
use Str;
use Session;
use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.categoria.index', ['categorias' => Categoria::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categoria $categoria)
    {
        return view('panel.categoria.form', compact('categoria'));
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

        $imagenName = Str::slug($request->categoria).'-'.time() . '.' .$request->file('meta_image')->getClientOriginalExtension();
        $request->file('meta_image')->move(base_path() . '/public/uploads/', $imagenName);

        $categoria = Categoria::create($request->only('categoria', 'meta_description', 'meta_keywords') + ['meta_image' => $imagenName]);

        Session::flash('mensaje', 'La categoria '.$categoria->categoria.' ha sido creada correctamente');
        return redirect(route('categorias.index'));

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
    public function edit(Categoria $categoria)
    {
        return view('panel.categoria.form', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        request()->validate([
            'categoria'=> 'required|max:255'
        ]);

        $categoria->fill($request->only('categoria', 'meta_description', 'meta_keywords'))->save();

        if($request->hasFile('meta_image')){
            $imagenName = Str::slug($request->categoria).'-'.time() . '.' .$request->file('meta_image')->getClientOriginalExtension();
            $request->file('meta_image')->move(base_path() . '/public/uploads/', $imagenName);
            $categoria->fill(['meta_image' => $imagenName])->save();
        }

        Session::flash('mensaje', 'La categoría  '.$categoria->categoria.' ha sido actualizada correctamente.');
        return redirect(route('categorias.edit', $categoria->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        Session::flash('mensaje', 'La Categoria '. $categoria->categoria.' ha sido eliminada.');
        return redirect(route('categorias.index'));
    }
}
