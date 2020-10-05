<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rubro;
use App\Categoria;
use Session;
use Str;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.rubros.index', ['rubros' => Rubro::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rubro $rubro)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.rubros.form', compact('rubro', 'categorias'));
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
            'rubro' => 'required|max:255'
        ]);

        $imagenName = Str::slug($request->rubro).'-'.time() . '.' .$request->file('meta_image')->getClientOriginalExtension();
        $request->file('meta_image')->move(base_path() . '/public/uploads/', $imagenName);

        $rubro = Rubro::create($request->only('categoria_id', 'rubro', 'meta_description') + ['meta_image' => $imagenName]);

        Session::flash('mensaje', 'El rubro '.$rubro->rubro.' ha sido creado correctamente');
        return redirect(route('rubros.index'));
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
    public function edit(Rubro $rubro)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.rubros.form', compact('rubro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubro $rubro)
    {
        request()->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'rubro' => 'required|max:255'
        ]);

        $rubro->fill($request->only('categoria_id', 'rubro', 'meta_description'))->save();

        if($request->hasFile('meta_image')){
            $imagenName = Str::slug($request->rubro).'-'.time() . '.' .$request->file('meta_image')->getClientOriginalExtension();
            $request->file('meta_image')->move(base_path() . '/public/uploads/', $imagenName);
            $rubro->fill(['meta_image' => $imagenName])->save();
        }

        Session::flash('mensaje', 'El rubro '.$rubro->rubro.' ha sido actualizado correctamente');
        return redirect(route('rubros.edit', $rubro->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubro $rubro)
    {
        $rubro->delete();
        Session::flash('mensaje', 'El rubro '.$rubro->rubro.' ha sido eliminado');
        return redirect(route('rubros.index'));
    }
}
