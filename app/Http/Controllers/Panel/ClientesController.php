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
use App\aex\AEX;
class ClientesController extends Controller
{
    //

    public function __construct(User $users, Role $roles, AEX $aex)
    {
		$this->middleware('auth');
    	$this->users = $users;
        $this->roles = $roles;
        $this->aexApi = $aex;
    }

    public function index()
    {
    	$users = $this->users->where('id','<>','0')->whereNotIn('id',function ($query){
        $query->select('user_id')
        ->from('role_user');
      })->get();

    	return view('panel.clientes.index', compact('users'));
    }

    public function create(User $user)
    {
        $roles = $this->roles->get()->all();

        return view('panel.clientes.form', compact('user', 'roles'));
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
        $roles = $this->roles->get()->all();
        $ciudadesPermitidas=array(
          'PY0000',
          'PY1103',
          'PY1107',
          'PY1108',
          'PY1109',
          'PY1110',
          'PY1112',
          'PY1114',
          'PY1115',
          'PY1101',
          'PY0304',
          'PY0301',
          'PY0502',
          'PY0703',
          'PY0512',
          'PY1102',
          'PY0905',
          'PY0707',
          'PY1001',
          'PY0501',
          'PY0701',
          'PY1005',
          'PY1105',
          'PY1106',
          'PY1119',
          'PY1007',
          'PY1011',
          'PY1002',
          'PY1117',
        );
        $aexApi=$this->aexApi;
        $array_ciudades=$aexApi->get_ciudades()['datos'];
        usort($array_ciudades, function($a, $b)
        {
            return strcmp($a["codigo_departamento"], $b["codigo_departamento"]);
        });
        foreach ($array_ciudades as $pos => $val) {
          if (!(in_array($val['codigo_ciudad'], $ciudadesPermitidas))) {
            unset($array_ciudades[$pos]);
          }
        }

        return view('panel.clientes.form', compact('user', 'roles', 'array_ciudades'));
    }
    public function editar_perfil()
    {
      $id = \Auth::user()->id;

        $user = $this->users->findOrFail($id);
        $roles = $this->roles->get()->all();;

        return view('panel.clientes.form', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
      request()->validate([
        'name'=> 'required|max:255',
        'email'=> 'required|max:255',
        'documento'=> 'required|max:255',
      ]);
        $user = $this->users->findOrFail($id);

        $user->fill($request->only('name', 'email','documento', 'calle_principal', 'calle_secundaria', 'telefono', 'celular', 'cod_ciudad'))->save();
        if(!empty($request->input('password')) && !empty($request->input('password_confirmation')) && $request->input('password') == $request->input('password_confirmation')) $user->fill([
            'password' => bcrypt($request->input('password'))
        ])->save();


        // $user->roles()->attach($request->rol);

        Session::flash('mensaje', 'El usuario ha sido actualizado correctamente');

        return redirect(route('clientes.edit', $user->id))->with('status', 'El cliente ha sido actualizado');
    }

    public function destroy(Request $request, $id)
    {
        if ($id == \Auth::user()->id) {
          Session::flash('mensaje', 'No se puede eliminar el actual cliente');
          return back();
        }

        $user = $this->users->findOrFail($id);

        $user->delete();
        Session::flash('mensaje', 'El cliente '. $user->name.' ha sido eliminado');
        return redirect(route('clientes.index'));
    }

    public function show($id)
    {
        return false;
    }



}
