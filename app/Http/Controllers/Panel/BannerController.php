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

    public function __construct(User $users, Role $roles, Banner $banners)
    {
      $this->middleware('auth');
      $this->users = $users;
      $this->roles = $roles;
      $this->banners = $banners;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $banners = $this->banners->orderBy('orden', 'desc')->get();

      return view('panel.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banner $banner)
    {
        $orden_maximo = $this->banners->get()->count()+1;
        return view('panel.banner.form', compact('banner', 'orden_maximo'));
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
        'titulo'=> 'required|max:255',
        'imagen'=> 'required|image'
      ]);

      $exploid_vencimiento=explode('/', $request['vencimiento']);
      $request['vencimiento']=$exploid_vencimiento[2].'-'.$exploid_vencimiento[1].'-'.$exploid_vencimiento[0];
      $request['vencimiento']=date('Y-m-d H:i:s',strtotime($request['vencimiento']));
      $request['visible']=$request['visible']?'1':'0';
      $banner = $this->banners->create($request->only('titulo', 'enlace', 'orden', 'tipo_vencimiento', 'vencimiento', 'visible', 'tipo_banner') + ['user_id'=> \Auth::user()->id]);
      if($request->hasFile('imagen')) {
          $imageName = str_slug($request->titulo).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
          if ($request['tipo_banner']==1) {
            $res[0]=1920;
            $res[1]=580;
          }else {
            $res[0]=600;
            $res[1]=800;
          }
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit($res[0], $res[1], function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $banner->fill(['imagen' => $imageName])->save();
      }
      Session::flash('mensaje', 'El banner '.$banner->titulo.' ha sido creado correctamente');
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
    public function edit($id)
    {
        $banner = $this->banners->findOrFail($id);
        $orden_maximo = $this->banners->get()->count()+1;
        return view('panel.banner.form', compact('banner', 'orden_maximo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'titulo'=> 'required|max:255'
      ]);
      $exploid_vencimiento=explode('/', $request['vencimiento']);
      $request['vencimiento']=$exploid_vencimiento[2].'-'.$exploid_vencimiento[1].'-'.$exploid_vencimiento[0];
      $request['vencimiento']=date('Y-m-d H:i:s',strtotime($request['vencimiento']));
      $request['visible']=$request['visible']?'1':'0';
      $banner = $this->banners->findOrFail($id);
      $banner->fill($request->only('titulo', 'enlace', 'orden', 'tipo_vencimiento', 'vencimiento', 'visible', 'tipo_banner'))->save();

      if($request->hasFile('imagen')) {
          $imageName = str_slug($request->titulo).'-'.time() . '.' .$request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move(base_path() . '/public/uploads/', $imageName);
          if ($request['tipo_banner']==1) {
            $res[0]=1920;
            $res[1]=580;
          }else {
            $res[0]=600;
            $res[1]=800;
          }
          Image::make(base_path() . '/public/uploads/' . $imageName)->fit($res[0], $res[1], function ($constraint) {
              $constraint->upsize();
              $constraint->aspectRatio();
          })->encode('jpg', 60)->save();

          $banner->fill(['imagen' => $imageName])->save();
      }

      Session::flash('mensaje', 'El banner  '.$banner->titulo.' ha sido actualizado correctamente');

      return redirect(route('banner.edit', $banner->id))->with('status', 'El banner ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $banner = $this->banners->findOrFail($id);

      $banner->delete();
      Session::flash('mensaje', 'El Banner '. $banner->titulo.' ha sido eliminado');
      return redirect(route('banner.index'));
    }
}
