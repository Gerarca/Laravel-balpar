<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServicioTecnicoInfo;
use Image;
use Session;


class ServicioTecnicoInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.servicio_tecnico_info.index', ['servicios' => ServicioTecnicoInfo::orderBy('created_at')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ServicioTecnicoInfo $servicio)
    {
        return view('panel.servicio_tecnico_info.form', compact("servicio"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $youtube = [];
        foreach($request->input("youtube") as $link){
            if(!empty($link)){
                $link = explode("?v=", $link);
                $youtube[] = $link[1];
            }else{
                $youtube[] = $link;
            }
        }

        if($request->hasFile("image1")){            
            $imageName = 'servicio-tecnico-'. time() . '.' .$request->file("image1")->getClientOriginalExtension();
            $request->file("image1")->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(1920, 700, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 60)->save();
            $image1 = $imageName;
        }


        if($request->hasFile("image2")){            
            $imageName = 'servicio-tecnico-'. time() . '.' .$request->file("image2")->getClientOriginalExtension();
            $request->file("image2")->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(1920, 700, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 60)->save();
            $image2 = $imageName;
        }

        $recurso = new ServicioTecnicoInfo;
        $recurso->type = json_encode($request->input("type"));
        $recurso->youtube_id = json_encode($youtube);
        // $recurso->image = json_encode($imagen);
        $recurso->image1 = $image1;
        $recurso->image2 = $image2;
        $recurso->save();
        
        Session::flash('mensaje', 'El recurso ha sido creado correctamente');
        return redirect(route('serviciovideos.index'))->with('status', 'El recurso ha sido creado');
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
    public function edit($id)
    {
        $servicio = ServicioTecnicoInfo::findOrFail($id);
        $type = json_decode($servicio->type);
        $image = json_decode($servicio->image);
        $youtube_id = json_decode($servicio->youtube_id);        
        
        return view('panel.servicio_tecnico_info.form', compact("servicio", "type", "image", "youtube_id"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recurso = ServicioTecnicoInfo::find($id);

        $youtube = [];
        foreach($request->input("youtube") as $link){
            if(!empty($link)){
                $link = explode("?v=", $link);
                $youtube[] = $link[1];
            }else{
                $youtube[] = $link;
            }
        }

        
        if($request->hasFile("image1")){            
            $imageName = 'servicio-tecnico-'. time() . '.' .$request->file("image1")->getClientOriginalExtension();
            $request->file("image1")->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(1920, 700, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 60)->save();
            $recurso->image1 = $imageName;
        }


        if($request->hasFile("image2")){            
            $imageName = 'servicio-tecnico-'. time() . '.' .$request->file("image2")->getClientOriginalExtension();
            $request->file("image2")->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(1920, 700, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 60)->save();
            $recurso->image2 = $imageName;
        }

        
        $recurso->type = json_encode($request->input("type"));
        $recurso->youtube_id = json_encode($youtube);
        // $recurso->image = json_encode($imagen);
        $recurso->save();
        
        Session::flash('mensaje', 'El recurso ha sido actualizado correctamente');
        return redirect(route('serviciovideos.edit', $recurso->id))->with('status', 'El recurso ha sido actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recurso = ServicioTecnicoInfo::find($id);

        $recurso->delete();
        Session::flash('mensaje', 'El Recurso del servicio ha sido eliminado');
        return redirect(route('serviciovideos.index'));
    }
}
