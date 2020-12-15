<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;
use DB;
use Session;
use App\User;
use App\Role;
use App\Blog;
use App\Categoria;
use Auth;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('fecha','desc')->get();
        return view('panel.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Blog $blog)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.blog.form', compact('blog','categorias'));
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
           'titulo' => 'required',
           'contenido' => 'required',
           'categoria_id' => 'required',
           'imagen' => 'required|image'
        ]);

        $request['user_id'] = Auth::user()->id;
        $request['fecha'] = Carbon::now()->format('Y-m-d');
        $blog = Blog::create($request->only('titulo', 'contenido', 'categoria_id','user_id','fecha'));

        $imageName = 'blog_'.$blog->id.time().'.'.$request->file('imagen')->getClientOriginalExtension();
        $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
        Image::make(base_path() . '/public/uploads/' . $imageName)->fit(870, 455, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        })->encode('jpg', 60)->save();
        $blog->fill(['imagen' => $imageName])->save();
        Session::flash('mensaje', 'El blog ha sido creado correctamente');
        return redirect(route('blog.index'))->with('status', 'El blog ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog  $blog)
    {
        $categorias = Categoria::orderBy('categoria')->get();
        return view('panel.blog.form', compact('blog', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog  $blog)
    {
        request()->validate([
           'titulo' => 'required',
           'contenido' => 'required',
           'categoria_id' => 'required',
        ]);

        $request['visible'] = $request['visible'] ? '1' : '0';

        $blog->fill($request->only('visible','titulo','contenido','categoria_id'))->save();

        if($request->hasFile('imagen')) {
            $imageName = 'blog_'.$blog->id. time() . '.' .$request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(870, 455, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 60)->save();
            $blog->fill(['imagen' => $imageName])->save();
        }

        Session::flash('mensaje', 'El blog ha sido actualizado correctamente');
        return redirect(route('blog.edit', $blog->id))->with('status', 'El blog ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog  $blog)
    {
        $blog->delete();
        Session::flash('mensaje', 'El blog ha sido eliminado');
        return redirect(route('blog.index'));
    }
}
