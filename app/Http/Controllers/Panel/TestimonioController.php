<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testimonio;
use Session;

class TestimonioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.testimonios.index', ['testimonios' => Testimonio::orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Testimonio $testimonio)
    {
        return view('panel.testimonios.form', compact('testimonio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonio $testimonio)
    {
        request()->validate(['visible' => 'required|integer']);
        $testimonio->fill($request->only('visible'))->save();

        if($testimonio->visible){
            Session::flash('mensaje', 'El testimonio de '. $testimonio->nombre .' está visible.');
        } else{
            Session::flash('mensaje', 'El testimonio de '. $testimonio->nombre .' se ocultó.');
        }

        return redirect(route('testimonios.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonio $testimonio)
    {
        $testimonio->delete();
        Session::flash('mensaje', 'El testimonio de '. $testimonio->nombre .' ha sido eliminado.');
        return redirect(route('testimonios.index'));
    }
}
