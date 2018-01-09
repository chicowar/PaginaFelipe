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





use App\Mail\DemoMail;

Route::get('enviar', ['as' => 'enviar', function () {



//  require_once '/vendor/autoload.php';

  // Create the Transport
  $transport = (new Swift_SmtpTransport('mailtrap.io', 2525))
    ->setUsername('f281feb954e867')
    ->setPassword('2c2278fda855c8')
  ;

  // Create the Mailer using your created Transport
  $mailer = new Swift_Mailer($transport);

  // Create a message
  $message = (new Swift_Message('Wonderful Subject'))
    ->setFrom(['john@doe.com' => 'John Doe'])
    ->subject([''])
    ->setTo(['jorge.chavez@overthetop.com.mx', 'jchavzr@gmail.com' => 'xx'])
    ->setBody('Hola mundo')
    ;

    // Send the message
    $result = $mailer->send($message);


// Sendmail
$transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');


/*
  $email = Auth::user()->email;
  Mail::to($email)->send(new DemoMail());
*/
/*
    $data = ['link' => 'http://styde.net'];

    \Mail::send('emails.prueba', $data, function ($message) {

        $message->from('email@styde.net', 'Styde.Net');

        $message->to('user@example.com')->subject('Notificación');

    });
*/
    return "Se envío el email";
}]);



Route::get('/', function () {
    return view('/auth/login');
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
