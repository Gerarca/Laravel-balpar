<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabajo;
use App\CategoriaTrabajo;
use Session;
use Image;
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
            'tipo' => 'required',
            'imagen' => 'image',
            'video' => 'max:11'
        ]);

        if($request->tipo == '1'){
            $destino = base_path() . '/public/uploads/';
            $imageName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
            try {
                Image::make($destino . $imageName)->resize(400, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . $imageName);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen no se pudo redimensionar porque es un formato no soportado');
            }

        } else {
            $imageName = NULL;
        }

        if($request->tipo == '2'){
            $videoName = $request->video;
        } else {
            $videoName = NULL;
        }

        Trabajo::create($request->only('categoria_id', 'nombre', 'descripcion', 'tipo') + ['imagen' => $imageName] + ['video' => $videoName]);

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
            'imagen' => 'image|nullable',
            'descripcion' => 'required'
        ]);
        $trabajo->fill($request->only('categoria_id', 'nombre', 'descripcion', 'tipo'))->save();

        if ($request->hasFile('imagen')) {
            $destino = base_path() . '/public/uploads/';
            $imageName = Str::slug($request->nombre) . '-' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
            $trabajo->fill(['imagen' => $imageName])->save();
            try {
                Image::make($destino . $imageName)->resize(400, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->encode('jpg', 70)->save($destino . $imageName);
            } catch (\Intervention\Image\Exception\NotSupportedException $e) {
                report($e);
                Session::flash('alerta', 'La imagen no se pudo redimensionar porque es un formato no soportado');
            }

        }

        if($request->tipo == '2'){
            $trabajo->fill(['video' => $request->video])->save();
            $trabajo->fill(['imagen' => NULL])->save();
        } else {
            $trabajo->fill(['video' => NULL])->save();
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
