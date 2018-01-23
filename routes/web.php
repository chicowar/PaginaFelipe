<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/*
Route::get('job',function(){
    dispatch(new App\Jobs\SendEmail);
    return "listo";
});
*/

Route::get('/firebase', 'FirebaseController@index');

Route::get('/', function () {
//    return view('/auth/login');
return view('welcome0');
});

Auth::routes();


//Rutas para vistas del usuario
Route::get('/contacto', 'EmpresaController@contacto');
Route::post('/mail', 'EmpresaController@mail');

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'EmpresaController@MisTarjetas')->name('home');

Route::get('/Empresa', 'EmpresaController@Empresa')->name('Empresa');
Route::get('/CrearTarjeta', 'EmpresaController@CrearTarjeta')->name('CrearTarjeta');
Route::post('/storeTarjeta', 'EmpresaController@storeTarjeta')->name('storeTarjeta');
Route::get('/storetarjeta/ubicacionget/{id}','EmpresaController@ubicacionget')->name('ubicacionget');
Route::get('/MisTarjetas', 'EmpresaController@MisTarjetas')->name('MisTarjetas');
Route::get('/usuarioAdmin', 'EmpresaController@usuarioAdmin')->name('usuarioAdmin');
Route::get('/Pago', 'EmpresaController@Pago')->name('Pago');
Route::post('/guardarregistro','homecontroller@guardaregistro')->name('guardaregsitro');
Route::post('/editTarjeta', 'EmpresaController@editTarjeta')->name('editTarjeta');

//grupos
Route::post('/grupo/store', 'EmpresaController@storegrupo')->name('storegrupo');
Route::get('/Gruposshow', 'EmpresaController@Gruposshow')->name('Gruposshow');

Route::post('/usuarios/store','EmpresaController@createAdmin')->name('createAdmin');
Route::get('/usuarios/{id}/edit','EmpresaController@editU')->name('editU');
Route::post('/usuarios/edit/{id}','EmpresaController@usuariosedit')->name('usuariosedit');
Route::delete('/usuarios/destroy/{id}', 'EmpresaController@destroyU');

Route::post('/empresa/edit/{id}','EmpresaController@editarempresa')->name('editarempresa');
Route::post('/empresa/storeempresa/{id}','EmpresaController@storeempresa')->name('storeempresa');
Route::post('empresa/storeubicacion','EmpresaController@storeubicacion')->name('storeubicacion');
Route::get('/empresa/ubicaciondelete/{id}','EmpresaController@ubicaciondelete')->name('ubicaciondelete');

Route::get('/gmaps', ['as ' => 'gmaps', 'uses' => 'EmpresaController@map']);
