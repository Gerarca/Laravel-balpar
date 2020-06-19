<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Data;
use Session;

class DataController extends Controller
{
    public function editNosotros()
    {
		$nosotros = Data::where('key', 'nosotros')->get()->first()->value;
		return view('panel.extras.nosotros', compact('nosotros'));
    }

    public function updateNosotros(Request $request)
    {
        $request->validate([
            'video' => 'nullable|alpha_dash|between:11,11'
        ]);

        Data::where('key', 'nosotros')->update([
            'value->video' => $request->video ?? null
        ]);

        Session::flash('mensaje', 'Los datos han sido actualizados correctamente');
        return redirect(route('nosotros.edit'));
    }

}
