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

class UsersController extends Controller
{
    //

    public function __construct(User $users, Role $roles)
    {
		$this->middleware('auth');
    	$this->users = $users;
        $this->roles = $roles;
    }

    public function index()
    {
    	$users = $this->users->where('id','<>','0')->whereIn('id',function ($query){
        $query->select('user_id')
        ->from('role_user');
      })->get();

    	return view('panel.users.index', compact('users'));
    }

    public function create(User $user)
    {
        $roles = $this->roles->get()->all();

        return view('panel.users.form', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
      request()->validate([
        'name'=> 'required|max:255',
        'email'=> 'required|unique:users|max:255',
        'password'=> 'required|max:255|confirmed',
        'image'=> 'required|image'
      ]);
        $request['password']=bcrypt($request['password']);
        $user = $this->users->create($request->only('name', 'email', 'password'));


        if($request->hasFile('image')) {
            $imageName = str_slug($user->name).'-'.time() . '.' .$request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 60)->save();

            $user->fill(['image' => $imageName])->save();
        }
        $user->roles()->attach($request->rol);

        return redirect(route('users.index'))->with('status', 'El usuario ha sido creado');
    }

    public function edit($id)
    {
        $user = $this->users->findOrFail($id);
        $roles = $this->roles->get()->all();;

        return view('panel.users.form', compact('user', 'roles'));
    }
    public function editar_perfil()
    {
      $id = \Auth::user()->id;

        $user = $this->users->findOrFail($id);
        $roles = $this->roles->get()->all();;

        return view('panel.users.form', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
      request()->validate([
        'name'=> 'required|max:255',
        'email'=> 'required|max:255',
      ]);
        $user = $this->users->findOrFail($id);

        $user->fill($request->only('name', 'email', 'rol'))->save();
        if(!empty($request->input('password')) && !empty($request->input('password_confirmation')) && $request->input('password') == $request->input('password_confirmation')) $user->fill([
            'password' => bcrypt($request->input('password'))
        ])->save();

        if($request->hasFile('image')) {
            $imageName = str_slug($user->name).'-'.time() . '.' .$request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(base_path() . '/public/uploads/', $imageName);
            Image::make(base_path() . '/public/uploads/' . $imageName)->fit(360, 360, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode('jpg', 60)->save();
            $user->fill(['image' => $imageName])->save();
        }
        $user->roles()->attach($request->rol);

        Session::flash('mensaje', 'El usuario ha sido actualizado correctamente');

        return redirect(route('users.edit', $user->id))->with('status', 'El usuario ha sido actualizado');
    }

    public function destroy(Request $request, $id)
    {
        if ($id == \Auth::user()->id) {
          Session::flash('mensaje', 'No se puede eliminar el actual usuario');
          return back();
        }

        $user = $this->users->findOrFail($id);

        $user->delete();
        Session::flash('mensaje', 'El usuario '. $user->name.' ha sido eliminado');
        return redirect(route('users.index'));
    }

    public function show($id)
    {
        return false;
    }



}
