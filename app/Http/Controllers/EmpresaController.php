<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

     public function usuarioAdmin()
     {
       $Users = Auth::user();

       $compañiaid = $Users->id_compania;

       $usuario = DB::table('users')
       //->leftjoin('areas','areas.id','=','users.id_area')
       ->select('users.*')
       ->where('users.id_compania',$Users->id_compania)
       ->get();

       return view('/Administracion/usuarioAdmin', compact('usuario'));
     }

     public function Pago()
     {

       return view('/Administracion/Pago');
     }

     protected function createAdmin(Request $request)
     {
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->id_compania = $request->input('empresauid');
        $user->save();

        return redirect('/usuarioAdmin');
     }

     public function editU($id){
       $user = User::find($id);
         return response()->json(
           $user->toArray()
         );
     }

     public function usuariosedit($id,Request $request)
     {
       $user = Auth::user();
       $usuarios = User::findorfail($id);

       //Campos normales
       if ($request->input('epassword') != null) {
         $usuarios->password = bcrypt($request->input('epassword'));
       }


       $usuarios->name = $request->input('enombre');
       $usuarios->email = $request->input('eemail');
       $usuarios->save();
       return redirect('/usuarioAdmin');
     }

     public function destroyU($id)
     {
       $usuarios = Auth::user();
       $user = User::findorfail($id);
       $user-> delete();


       return redirect('/usuarioAdmin');

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
