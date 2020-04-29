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
use App\Banner;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.banner.index', ['banners' => Banner::orderBy('orden')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banner $banner)
    {
        $orden_maximo = Banner::all()->count() + 1;
        return view('panel.banner.form', compact('orden_maximo', 'banner'));
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
            'imagen' => 'required|image'
        ]);

        $orden_actual = Banner::where('orden', '>=', $request['orden']);

        if($orden_actual->exists()){
            $orden_actual->increment('orden');
        }

        $request['visible'] = $request['visible'] ? '1' : '0';

        $imageName = 'banner-'. time() . '.' .$request->file('imagen')->getClientOriginalExtension();
        $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
        Image::make(base_path() . '/public/uploads/' . $imageName)->fit(1920, 700, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        })->encode('jpg', 60)->save();

        $banner = Banner::create($request->only('visible', 'orden') + ['imagen' => $imageName]);

        Session::flash('mensaje', 'El banner ha sido creado correctamente');
        return redirect(route('banner.index'))->with('status', 'El banner ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $orden_maximo = Banner::all()->count();
        return view('panel.banner.form', compact('orden_maximo', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        request()->validate([
            'imagen' => 'image'
        ]);

        if(request()->orden != $banner->orden){

            $orden_viejo = Banner::where('orden', $request["orden"]);
            $orden_viejo->update(['orden' => $banner->orden]);
            $banner->orden = request('orden');
            $banner->save();
        }

        $request['visible'] = $request['visible'] ? '1' : '0';
        $banner->fill($request->only('visible', 'orden'))->save();

        if($request->hasFile('imagen')) {
            $imageName = 'banner_edit-'. time() . '.' .$request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(1920, 700, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 70)->save();
            $banner->fill(['imagen' => $imageName])->save();
        }

        Session::flash('mensaje', 'El banner ha sido actualizado correctamente');
        return redirect(route('banner.edit', $banner->id))->with('status', 'El banner ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $orden_actual = Banner::where('orden', '>=', $banner['orden']);

        if($orden_actual->exists()){
            $orden_actual->decrement('orden');
        }

        $banner->delete();
        Session::flash('mensaje', 'El Banner ha sido eliminado');
        return redirect(route('banner.index'));
    }
}
