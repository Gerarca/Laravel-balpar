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
use App\Newsletter;

use App\Exports\NewsletterExport;
use Maatwebsite\Excel\Facades\Excel;

class NewsletterController extends Controller
{

    public function __construct(User $users, Role $roles, Newsletter $newsletters)
    {
      $this->middleware('auth');
      $this->users = $users;
      $this->roles = $roles;
      $this->newsletters = $newsletters;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $newsletters = $this->newsletters->get();

      return view('panel.newsletter.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Newsletter $newsletter)
    {
      return response(view('exports.newsletter', [
         'newsletters' => Newsletter::get()
     ]))
     ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
     ->header('Content-Disposition', 'attachment; filename=newsletter.xls')
     ->header('Expires', '0');

        // return view('panel.newsletter.form', compact('newsletter'));
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
        'mail'=> 'required|max:255',
      ]);


      $request['visible']=$request['visible']?'1':'0';
      $newsletter = $this->newsletters->create($request->only('mail', 'visible') + ['user_id'=> \Auth::user()->id]);

      Session::flash('mensaje', 'La newsletter '.$newsletter->newsletter.' ha sido creada correctamente');
        return redirect(route('newsletter.index'))->with('status', 'La newsletter ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsletter = $this->newsletters->findOrFail($id);
        return view('panel.newsletter.form', compact('newsletter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'mail'=> 'required|max:255',
      ]);
      $request['visible']=$request['visible']?'1':'0';
      $newsletter = $this->newsletters->findOrFail($id);
      $newsletter->fill($request->only('mail'))->save();



      Session::flash('mensaje', 'La newsletter  '.$newsletter->newsletter.' ha sido actualizada correctamente');

      return redirect(route('newsletter.edit', $newsletter->id))->with('status', 'La newsletter ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $newsletter = $this->newsletters->findOrFail($id);

      $newsletter->delete();
      Session::flash('mensaje', 'El Newsletter '. $newsletter->newsletter.' ha sido eliminada');
      return redirect(route('newsletter.index'));
    }
}
