<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Empresa;
use App\Models\empresausuarios;
use App\Models\empresaubicacion;
use App\Models\Grupos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Mail\AdminCreado;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Mail\Message;

use App\Events\TarjetaWasCreated;



class EmpresaController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function contacto()
  {
      return view('contacto');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function mail(Request $request)
  {
    Mail::send('emails.contact',$request->all(), function($msj){
      $msj->subject('Correo de contacto');
      $msj->to('jorge.chavez@overthetop.com.mx');
    });
    Session::flash('message','Enviado correctamente');

  }







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

     $ubicaciones = empresaubicacion::where('id_compania','=',$empresaid)->get();


     // configuracion google maps
     $config = array();
     $config['center'] = 'auto';
     $config['onboundschanged'] = 'if (!centreGot) {
             var mapCentre = map.getCenter();
             var infowindow = new google.maps.InfoWindow();
             marker_0.setOptions({
                 position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
             });
             var geocoder;
             geocoder = new google.maps.Geocoder();
             var latlng = new google.maps.LatLng(mapCentre.lat(), mapCentre.lng());
               geocoder.geocode({latLng: latlng}, function(results, status) {
                 if (status == google.maps.GeocoderStatus.OK) {
                   if (results[0]) {
                     map.fitBounds(results[0].geometry.viewport);

                     $("#address").text(results[0].formatted_address);
                      $("#direccion").val(results[0].formatted_address);

                   } else {
                     $("#address").text("No se encontro registro del lugar seleccionado");
                      $("#direccion").val("No se encontro registro del lugar seleccionado");
                   }
                 } else {
                   $("#address").text("No se encontro registro del lugar seleccionado " + status);
                   $("#direccion").val(results[0].formatted_address);
                 }
               });
         }
         centreGot = true;';
     $config['places'] = TRUE;
     $config['placesAutocompleteInputID'] = 'searchmap';
     $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
     $config['placesAutocompleteOnChange'] = '
                     var place = placesAutocomplete.getPlace();
                     marker_0.setOptions({position: {lat: place.geometry.location.lat(), lng: place.geometry.location.lng()} });
                     if (!place.geometry) {
                       // User entered the name of a Place that was not suggested and
                       // pressed the Enter key, or the Place Details request failed.
                       window.alert("No se encontro la ubicacion de tu busqueda");
                       return;
                     }

                     // If the place has a geometry, then present it on a map.
                     if (place.geometry.viewport) {
                       map.fitBounds(place.geometry.viewport);

                     } else {
                       map.setCenter(place.geometry.location);
                       map.setZoom(17);  // Why 17? Because i want.
                     }
                     var address = "";
                     if (place.address_components) {
                       address = [
                         (place.address_components[0] && place.address_components[0].short_name || ""),
                         (place.address_components[1] && place.address_components[1].short_name || ""),
                         (place.address_components[2] && place.address_components[2].short_name || "")
                       ].join("");
                     };

                     var geocoder;
                     geocoder = new google.maps.Geocoder();
                     var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
                       geocoder.geocode({latLng: latlng}, function(results, status) {
                         if (status == google.maps.GeocoderStatus.OK) {
                           if (results[0]) {
                             map.fitBounds(results[0].geometry.viewport);
                             $("#address").text(results[0].formatted_address);
                              $("#direccion").val(results[0].formatted_address);
                            } else {
                              $("#address").text("No se encontro registro del lugar seleccionado");
                               $("#direccion").val("No se encontro registro del lugar seleccionado");
                            }
                          } else {
                            $("#address").text("No se encontro registro del lugar seleccionado " + status);
                            $("#direccion").val(results[0].formatted_address);
                          }
                       });';

      $config['onclick'] = '$("#lat").val(event.latLng.lat()); $("#lng").val(event.latLng.lng());
      marker_0.setOptions({position: {lat: event.latLng.lat(), lng: event.latLng.lng()} });
      var geocoder;
      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
        geocoder.geocode({latLng: latlng}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              map.fitBounds(results[0].geometry.viewport);
              $("#address").text(results[0].formatted_address);
               $("#direccion").val(results[0].formatted_address);
             } else {
               $("#address").text("No se encontro registro del lugar seleccionado");
                $("#direccion").val("No se encontro registro del lugar seleccionado");
             }
           } else {
             $("#address").text("No se encontro registro del lugar seleccionado " + status);
             $("#direccion").val(results[0].formatted_address);
           }
        });';

     app('map')->initialize($config);

     // set up the marker ready for positioning
     // once we know the users location marker_0.setOptions({
     // position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) });
     $marker = array();
     $marker['draggable'] = true;
     $marker['ondrag'] = '$("#lat").val(event.latLng.lat());$("#lng").val(event.latLng.lng());';
     $marker['ondragend'] = '$("#lat").val(event.latLng.lat());$("#lng").val(event.latLng.lng());
     var geocoder;
     geocoder = new google.maps.Geocoder();
     var latlng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
       geocoder.geocode({latLng: latlng}, function(results, status) {
         if (status == google.maps.GeocoderStatus.OK) {
           if (results[0]) {
             map.fitBounds(results[0].geometry.viewport);
             $("#address").text(results[0].formatted_address);
              $("#direccion").val(results[0].formatted_address);
            } else {
              $("#address").text("No se encontro registro del lugar seleccionado");
               $("#direccion").val("No se encontro registro del lugar seleccionado");
            }
          } else {
            $("#address").text("No se encontro registro del lugar seleccionado " + status);
            $("#direccion").val(results[0].formatted_address);
          }
       });';
     $marker['onpositionchanged'] = '$("#lat").val(marker_0.position.lat());$("#lng").val(marker_0.position.lng()); ';
     app('map')->add_marker($marker);

     $map = app('map')->create_map();

     $ubicaciones = empresaubicacion::where('id_compania','=',$empresaid)->get();

        return view('/Administracion/empresa', compact('empresa','map','ubicaciones'));
    }

    public function CrearTarjeta()
    {


      $user = Auth::user();
      $empresaid = $user->id_compania;
      $empresa = Empresa::where('id_compania','=',$empresaid)->first();

      $ubicaciones = empresaubicacion::where('id_compania','=',$empresaid)->get();

      $grupos = Grupos::where('id_compania','=',$empresaid)->orderby('id')->get();

      $vencimiento = Carbon::now(-5)->toAtomString();



      return view('/Administracion/CrearTarjeta',compact('ubicaciones','grupos','vencimiento'));

    }

    public function MisTarjetas()
    {
      $user = Auth::user();
      $empresaid = $user->id_compania;
      $abecedario=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
      $grupos = Grupos::where('id_compania','=',$empresaid)->get();

      $empresa = Empresa::where('id_compania','=',$empresaid)->first();

      $ubicaciones = empresaubicacion::where('id_compania','=',$empresaid)->get();

      $grupos = Grupos::where('id_compania','=',$empresaid)->orderby('id')->get();

      return view('/Administracion/MisTarjetas', compact('abecedario','ubicaciones','grupos'));
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
      $today = Carbon::now(-5)->todatestring();


      return view('/Administracion/Pago',compact('today'));
    }

    protected function createAdmin(Request $request)
    {


      $v = \Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
      ],[
    'email.unique' => 'Ya existe un usuario con ese correo, cambia de correo.',
]);

//return(dd($v->errors()));

     if ($v->fails())
      {

        return redirect()->back()->withInput()->withErrors($v->errors());

      }

       $usr = new User;
       $usr->name = $request->input('name');
       $usr->email = $request->input('email');
       $usr->password = bcrypt($request->input('password'));
       $usr->id_compania = $request->input('empresauid');
       $usr->save();

        $id = $usr->id;

        $user = User::find($id);

        $Users = Auth::user();
        //$admins= user::where

      Mail::Queue(new AdminCreado($request));



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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeubicacion(Request $request)
    {
        //
        //return(dd($request));
        $user = Auth::user();
        $empresaid = $user->id_compania;

        $tablaempresa= Empresa::where('id_compania','=',$empresaid)->first();

        if($request->detalle == null)
        {
          $detail = "";
        }
        else {
          $detail = $request->detalle;
        }


        $empresaubicacion = new empresaubicacion;
        $empresaubicacion->id_empresas = $tablaempresa->id;
        $empresaubicacion->id_compania = $empresaid;
        $empresaubicacion->direccion = $request->direccion;
        $empresaubicacion->detalle = $request->detalle;
        $empresaubicacion->lat = $request->lat;
        $empresaubicacion->lng = $request->lng;
        $empresaubicacion->detalle = $detail;

        $empresaubicacion->save();

        $user = Auth::user();
        $empresaid = $user->id_compania;
        $empresa = Empresa::where('id_compania','=',$empresaid)->first();

       $ubicaciones = empresaubicacion::where('id_compania','=',$empresaid)->get();

       return response()->json($ubicaciones->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeempresa($id,Request $request)
    {
        //
        $user = Auth::user();
        $empresaid = $user->id_compania;

        Empresa::where('id_compania','=',$empresaid)->update([
        'name' => $request->nombre,
        'url' => $request->url
      ]);

       $empresa = Empresa::where('id_compania','=',$empresaid)->first();

       return response()->json(
         $empresa->toArray()
       );
    }


    public function storegrupo(Request $request)
    {
        //
        $user = Auth::user();
        $empresaid = $user->id_compania;
        $Grupos = new Grupos;
        $Grupos->grupo = $request->grupo;
        $Grupos->id_compania = $empresaid;
        $Grupos->save();
        return redirect()->action('EmpresaController@MisTarjetas');

    }



      public function Gruposshow(){

        $user = Auth::user();
        $empresaid = $user->id_compania;

  /*      $grupo = new Grupos;
        $grupos = $grupo->where('id_compania','=',$empresaid)->get();
*/

        $grupos = Grupos::where('id_compania','=',$empresaid)->get();

    /*   $grupo = new Grupos;
        $grupos = $grupo->all();*/
        return response()->json(
          $grupos->toarray()
        );
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
/*
       User::where('id_compania', $user->id_compania)
                 ->update(['archivo' => $file->getClientOriginalName()]);
*/

       Empresa::where('id_compania', $user->id_compania)
                 ->update(['archivo' => $file->getClientOriginalName()]);


       return response()->json($user);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeTarjeta(Request $request)
    {

       //
       //return(dd($request));
       $user = new empresausuarios;
       $user->id_compania = $request->empresauid;
       $user->uid = $request->uid;
       $user->nombreusuario = $request->first_name;
       $user->grupo = $request->eligegrupo;
       $user->save();


       Session::flash('flash_message', 'Se guardo correctamente la tarjeta de: '.$request->first_name);

       $user = Auth::user();

       $tarjeta = $request->all();

       event(new TarjetaWasCreated($tarjeta,$user->email));

       return redirect()->action('EmpresaController@CrearTarjeta');

    }


    public function editTarjeta(Request $request)
    {

       //return(dd($request));
       empresausuarios::where('uid',$request->uid)
       ->update(['nombreusuario' => $request->first_name,
                 'grupo' => $request->eligegrupomod]);

       Session::flash('flash_message', 'Se edito correctamente la tarjeta de: '.$request->first_name);

       return redirect()->action('EmpresaController@MisTarjetas');

    }






    /**
     * obtiene latitud y longitud.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ubicacionget($id)
    {
        //
        $ubica = empresaubicacion::findorfail($id);

        return response()->json(
          $ubica->toArray()
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ubicaciondelete($id)
    {
        //
        empresaubicacion::where('id','=',$id)->delete();

        $user = Auth::user();
        $empresaid = $user->id_compania;
        $empresa = Empresa::where('id_compania','=',$empresaid)->first();

        $ubicaciones = empresaubicacion::where('id_compania','=',$empresaid)->get();

        return response()->json(
          $ubicaciones->toArray()
        );
    }
}
