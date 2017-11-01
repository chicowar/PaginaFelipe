<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }


    public function Empresa()
    {

      $user = Auth::user();

      $empresaid = $user->id_compania;

      $empresa = Empresa::where('id_compania','=',$empresaid)->first();

        return view('/Administracion/empresa', compact('empresa'));
    }

    public function CrearTarjeta()
    {
        return view('/Administracion/CrearTarjeta');
    }

    public function MisTarjetas()
    {
      $abecedario=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

        return view('/Administracion/MisTarjetas', compact('abecedario'));
    }

    public function index()
    {
        //return view('/Administracion/empresa');
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
     public function editarempresa($id,Request $request)
     {

       $user = User::findorfail($id);

       $file = $request->file('files');
       $user->archivo = $file->getClientOriginalName();
       $user->save();

       return response()->json([
         'mensaje' => "listo"
       ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
