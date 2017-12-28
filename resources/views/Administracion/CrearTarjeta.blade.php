@extends('layouts.app')

@section('content')
    <link href="css/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>
    <link href="css/plugins/chosen/chosen.css" rel="stylesheet">

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif


<center>
@if(Session::has('flash_message'))
<script>
setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 5000
        };
        toastr.info('{{Session::get('flash_message')}}', 'Tarjeta guardada');

    }, 0);
</script>
@endif
</center>

<div class="container">
  <div class="row">

<form role="form" data-toggle="validator"class="well form-horizontal" action="/storeTarjeta" method="post"  id="tarjetaForm">
<fieldset>
  {{ csrf_field() }}


  <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
  <input type="text" id="id" name="id" value="{{ Auth::user()->id }}" style="display:none;" />
  <input type="text" id="archivoname" name="archivoname" value="{{ Auth::user()->archivo }}" style="display:none;" />
  <input type="text" id="tarjetaid" name="tarjetaid" value="" style="display:none;" />
  <input type="text" id="ubicacion" name="ubicacion" value="" style="display:none;" />
  <input type="text" id="lat" name="lat" value="" style="display:none;" />
  <input type="text" id="lng" name="lng" value="" style="display:none;" />
  <input type="text" id="uid" name="uid" value="" style="display:none;" />

<!-- Form Name -->
<legend>Crear Usuario de Tarjeta</legend>

<!-- Text input-->

  <div class="form-group">
    <label class="col-md-4 control-label">Nombre *</label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="first_name" placeholder="Nombre" id="Nombre" class="form-control"  type="text" required>
      </div>
    </div>
  </div>

  <!-- Text input-->
         <div class="form-group">
    <label class="col-md-4 control-label">Puesto *</label>
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
    <input name="puesto" id="puesto" placeholder="Puesto" class="form-control"  type="text" required>
      </div>
    </div>
  </div>


<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label">E-Mail *</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email" placeholder="E-Mail" id="email" class="form-control"  type="text" required>
    </div>
  </div>
</div>


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Telefono de contacto *</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
  <input name="phone" placeholder="8455551212" id="phone" class="form-control" type="number" required>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Whatsapp</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>
  <input name="whatsapp" placeholder="8455551212" id="whatsapp" class="form-control" type="number">
    </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label">Ubicacion de sucursal</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>

        <select class="chosen-select form-control" name="ubicacionselect" id="ubicacionselect">
          <option value="">Elige una ubicacion</option>
          @foreach ($ubicaciones as $ubicacion)
          <option value="{{ $ubicacion->id}}">{{ $ubicacion->direccion }} </option>
          @endforeach
        </select>

    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Grupo:</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-users"></i></span>
        <select class="chosen-select form-control required" id="eligegrupo" name="eligegrupo" required >
          @foreach ($grupos as $grupo)
          @if($grupo->grupo == 'Sin grupo')
          <option value="{{ $grupo->id}}" selected="selected">{{ $grupo->grupo }} </option>
          @else
           <option value="{{ $grupo->id}}">{{ $grupo->grupo }} </option>
           @endif
          @endforeach
        </select>

    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Fotografia:</label>
<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="form-group">
    <center>
      <a id="archivobtn" type="button" value="Seleccionearchivo" ><output id="list"><img src="/img/profile-icon-1.png" alt="Foto" height="142" width="142" class="img-rounded" id="myimg"></output></a>
    <progress id="uploader" value="0" max="100">0%</progress>
  </center>
  </div>
    <input type="file" id="files" name="files" style="display:none;" />
</div>

</div>


<!-- Success message -->
<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button id="submittarjeta" name="submittarjeta" type="submit" class="btn btn-warning"  >Guardar datos de tarjeta <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>
<center><label class="col-md-12 control-label">* Campos obligatorios</label></center>
</fieldset>
</form>
</div>
    </div><!-- /.container -->

    <script src="js/tarjeta.js"></script>
    <script type="text/javascript">


    $(document).ready(function() {

      $(".chosen-select").chosen({width: "100%"});

    $('#tarjetaid').val(uniqid());

      $("#ubicacionselect").change(function() {
        //$('#proveedor').val('0').find('option[value="0"]‌​').remove();
        //$("#ubicacionselect option[value='']").remove();

        $('#ubicacion').val($('#ubicacionselect option:selected').text());

        var id = $('#ubicacionselect').val();
        var route = "/storetarjeta/ubicacionget/"+ $('#ubicacionselect').val();


        $.get(route, function(res){

          $('#lat').val(res.lat);

          $('#lng').val(res.lng);

          });
       });


    });


    function archivo(evt) {
          var files = evt.target.files; // FileList object

            //Obtenemos la imagen del campo "file".
          for (var i = 0, f; f = files[i]; i++) {
               //Solo admitimos imágenes.
               if (!f.type.match('image.*')) {
                    continue;
               }

               var reader = new FileReader();

               reader.onload = (function(theFile) {
                   return function(e) {
                   // Creamos la imagen.
                          document.getElementById("list").innerHTML = ['<img height="142" width="142" class="img-rounded" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                   };
               })(f);

               reader.readAsDataURL(f);
           }
    }

  document.getElementById('files').addEventListener('change', archivo, false);



  $('#archivobtn').click(function () {
      $("#files").click();
  });





         function NuevaTarjetax(){

           // nuevo codigo
           // detenemos submit

           event.preventDefault();


           var formulario = document.getElementById("tarjetaForm");

           // Initialize Firebase
           // creamos el login de firebase
           // si hay error se va al catch de login

           firebase.auth().createUserWithEmailAndPassword($('#email').val(), '1234567')
           .then(function(user){

           $('#uid').val(user.uid);

            console.log('se creo el login');
          // se creo el login de firebase obtenemos el uid


             var uploader = document.getElementById('uploader');
             var file =  $('#files')[0].files[0]
             var validafile = $('#files').val();

             if(validafile != ''){
               var filename = file.name;
             }
             else {
               var filename = ''
             }


            // validar si se cargo archivo
            // si no se carga imagen en el formulario
            // no se ejecuta el codigo hasta el mensaje else de imagen

             if(validafile != '')
             {

               var storageRef = firebase.storage().ref('usuarios/'+user.uid+'/'+filename);
               var task = storageRef.put(file);
               task.on('state_changed', function progress(snapshot) {
                 var percentage = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
                 uploader.value = percentage;

               }, function error(err) {
              // si se genera error al cargar el archivo da mensaje de error y elimina login de firebase
                   console.log('error en la carga del archivo');
                 admin.auth().deleteUser(user.uid)
                 .then(function() {
                   console.log('se borro el login por el error en la carga del archivo');
                   // aqui entra si hubo error en la carga del archivo
                   // y si pudo  borrarse el archivo

                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             timeOut: 5000
                         };
                         toastr.error('Verifica la imagen cargada', 'Error en carga de archivo');

                     }, 0);
                 return false;
               })
               .catch(function(error) {
                 // si se genera un error al borrar el usuario de firebase
                 console.log('error al borrar login por carga del archivo');
                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             timeOut: 5000
                         };
                         toastr.error('Error en carga de archivo y borrado de login', 'Error en carga de archivo');

                     }, 0);
                 return false;
               });
               },function complete() {
                 console.log('se guardo archivo');
                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             timeOut: 5000
                         };
                         toastr.success('Guardada imagen de tarjeta', 'Carga de imagen correcta');

                     }, 0);
               });
               // equivale al else imagen
               // aqui entra si ya se genero el login en firebase
               // y se guardo correctamente el archivobt
               // aqui se genera el nodo de la tarjeta
               firebase.database().ref('usuarios/'+user.uid).set({
                 username: $('#Nombre').val(),
                 email: $('#email').val(),
                 phone: $('#phone').val(),
                 puesto: $('#puesto').val(),
                 ubicacion: $('#ubicacion').val(),
                 lat:  $('#lat').val(),
                 lng:  $('#lng').val(),
                 imagen_de_perfil : filename,
                 empresauid: $('#empresauid').val(),
                 whatsapp: $('#whatsapp').val(),
                 Enviadas: 0,
                 Recibidas: 0,
                 Favoritas: 0,
                 Publico: 1,
                 grupo: $('#eligegrupo').val()


             }).catch(function(error) {
               console.log('error al crear nodo');
                 //Handle error
                 // aqui entra si se genero un error al crear el nodo de tarjeta en firebase
                 // se debe borrar el archivo
                 // se debe borrar el login

                 if(validafile != '')
                 {
                 storageRef.delete(file).then(function() {

                   console.log('exito al borrar archivo x eror en crear nodo');
                   // Exito en el borrado del archivo
                   //se borra authenticacion


                 }).catch(function(error) {
                   // Error en el borrado del archivo
                   setTimeout(function() {
                           toastr.options = {
                               closeButton: true,
                               progressBar: true,
                               showMethod: 'slideDown',
                               closeMethod: 'fadeOut',
                               timeOut: 4000
                           };
                           toastr.error('Error al guardar la tarjeta, eliminar archivo y login', 'Error de firebase');

                       }, 0);

                   return false;
                 });
                 }

                 admin.auth().deleteUser(user.uid)
                 .then(function() {
                    console.log('exito al borrar login x error al crear nodo');
                   // aqui entra si hubo error en la carga del archivo
                   // y si pudo  borrarse el archivo

                   setTimeout(function() {
                           toastr.options = {
                               closeButton: true,
                               progressBar: true,
                               showMethod: 'slideDown',
                               closeMethod: 'fadeOut',
                               timeOut: 4000
                           };
                           toastr.error('Error al guardar la tarjeta verifica tus datos', 'Error de firebase');

                       }, 0);

                   return false;
               })
               .catch(function(error) {
                   console.log('error al borrar login x error al crear nodo');
                 // si se genera un error al borrar el usuario de firebase
                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             closeMethod: 'fadeOut',
                             timeOut: 4000
                         };
                         toastr.error('Error al guardar la tarjeta y eliminar login', 'Error de firebase');

                     }, 0);

                 return false;
               });

             });

           formulario.submit();

             }


             else {

               // equivale al else imagen
               // la unica diferencia es que no genera nodo imagen_de_perfil para evitar errores en la app
               // aqui entra si ya se genero el login en firebase
               // y se guardo correctamente el archivobt
               // aqui se genera el nodo de la tarjeta
               firebase.database().ref('usuarios/'+user.uid).set({
                 username: $('#Nombre').val(),
                 email: $('#email').val(),
                 phone: $('#phone').val(),
                 puesto: $('#puesto').val(),
                 ubicacion: $('#ubicacion').val(),
                 lat:  $('#lat').val(),
                 lng:  $('#lng').val(),
                 empresauid: $('#empresauid').val(),
                 whatsapp: $('#whatsapp').val(),
                 Enviadas: 0,
                 Recibidas: 0,
                 Favoritas: 0,
                 Publico: 1,
                 grupo: $('#eligegrupo').val()


             }).catch(function(error) {
               console.log('error al crear nodo');
                 //Handle error
                 // aqui entra si se genero un error al crear el nodo de tarjeta en firebase
                 // se debe borrar el archivo
                 // se debe borrar el login

                 if(validafile != '')
                 {
                 storageRef.delete(file).then(function() {

                   console.log('exito al borrar archivo x eror en crear nodo');
                   // Exito en el borrado del archivo
                   //se borra authenticacion




                 }).catch(function(error) {
                   // Error en el borrado del archivo
                   setTimeout(function() {
                           toastr.options = {
                               closeButton: true,
                               progressBar: true,
                               showMethod: 'slideDown',
                               closeMethod: 'fadeOut',
                               timeOut: 4000
                           };
                           toastr.error('Error al guardar la tarjeta, eliminar archivo y login', 'Error de firebase');

                       }, 0);

                   return false;
                 });
                 }

                 admin.auth().deleteUser(user.uid)
                 .then(function() {
                    console.log('exito al borrar login x error al crear nodo');
                   // aqui entra si hubo error en la carga del archivo
                   // y si pudo  borrarse el archivo

                   setTimeout(function() {
                           toastr.options = {
                               closeButton: true,
                               progressBar: true,
                               showMethod: 'slideDown',
                               closeMethod: 'fadeOut',
                               timeOut: 4000
                           };
                           toastr.error('Error al guardar la tarjeta verifica tus datos', 'Error de firebase');

                       }, 0);

                   return false;
               })
               .catch(function(error) {
                   console.log('error al borrar login x error al crear nodo');
                 // si se genera un error al borrar el usuario de firebase
                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             closeMethod: 'fadeOut',
                             timeOut: 4000
                         };
                         toastr.error('Error al guardar la tarjeta y eliminar login', 'Error de firebase');

                     }, 0);

                 return false;
               });

             });

           formulario.submit();
}
       }).catch(function(error) {
       // Handle Errors here.
     // si hay error al crear el login avisa por que
     // catch de login

       switch(error.message) {
           case 'The email address is badly formatted.':
           setTimeout(function() {
                   toastr.options = {
                       closeButton: true,
                       progressBar: true,
                       showMethod: 'slideDown',
                       timeOut: 5000
                   };
                   toastr.error('Inserta una direccion de correo valida', 'Error en formato de correo electronico');
               }, 0);
               break;
           case 'The email address is already in use by another account.':
           setTimeout(function() {
                   toastr.options = {
                       closeButton: true,
                       progressBar: true,
                       showMethod: 'slideDown',
                       closeMethod: 'fadeOut',
                       timeOut: 5000
                   };
                   toastr.error('Esta direccion de correo ya existe en BU, es necesario crear nueva tarjeta', 'Usuario ya existe');
               }, 0);
               break;
           default:
           setTimeout(function() {
                   toastr.options = {
                       closeButton: true,
                       progressBar: true,
                       showMethod: 'slideDown',
                       closeMethod: 'fadeOut',
                       timeOut: 5000
                   };
                   toastr.error(error.message, error.code);

               }, 0);
       }


       return Result = false;
       // ...
     });

}


/*

            // else de carga de imagen
             else {

               // aqui entra si ya se genero el login en firebase
               // y se guardo correctamente el archivobt
               // aqui se genera el nodo de la tarjeta
               firebase.database().ref('usuarios/'+user.uid).set({
                 username: $('#Nombre').val(),
                 email: $('#email').val(),
                 phone: $('#phone').val(),
                 puesto: $('#puesto').val(),
                 ubicacion: $('#ubicacion').val(),
                 lat:  $('#lat').val(),
                 lng:  $('#lng').val(),
                 imagen_de_perfil : file.name,
                 empresauid: $('#empresauid').val(),
                 whatsapp: $('#whatsapp').val(),
                 Enviadas: 0,
                 Recibidas: 0,
                 Favoritas: 0,
                 Publico: 1


             }).catch(function(error) {
                 //Handle error
                 // aqui entra si se genero un error al crear el nodo de tarjeta en firebase
                 // se debe borrar el login
                   //se borra authenticacion


                   admin.auth().deleteUser(user.uid)
                   .then(function() {

                     // aqui entra si hubo error en la carga del archivo
                     // y si pudo  borrarse el archivo
                     console.log("Successfully deleted user");

                     setTimeout(function() {
                             toastr.options = {
                                 closeButton: true,
                                 progressBar: true,
                                 showMethod: 'slideDown',
                                 closeMethod: 'fadeOut',
                                 timeOut: 4000
                             };
                             toastr.error('Error al guardar la tarjeta verifica tus datos', 'Error de firebase');

                         }, 0);

                     return false;
                 })
                 .catch(function(error) {
                   // si se genera un error al borrar el usuario de firebase
                   setTimeout(function() {
                           toastr.options = {
                               closeButton: true,
                               progressBar: true,
                               showMethod: 'slideDown',
                               closeMethod: 'fadeOut',
                               timeOut: 4000
                           };
                           toastr.error('Error al guardar la tarjeta verifica tus datos', 'Error de firebase');

                       }, 0);

                   return false;
                 });



             });


           formulario.submit();


             }


           }).catch(function(error) {
           // Handle Errors here.
         // si hay error al crear el login avisa por que
         // catch de login

           switch(error.message) {
               case 'The email address is badly formatted.':
               setTimeout(function() {
                       toastr.options = {
                           closeButton: true,
                           progressBar: true,
                           showMethod: 'slideDown',
                           timeOut: 5000
                       };
                       toastr.error('Inserta una direccion de correo valida', 'Error en formato de correo electronico');
                   }, 0);
                   break;
               case 'The email address is already in use by another account.':
               setTimeout(function() {
                       toastr.options = {
                           closeButton: true,
                           progressBar: true,
                           showMethod: 'slideDown',
                           closeMethod: 'fadeOut',
                           timeOut: 5000
                       };
                       toastr.error('Esta direccion de correo ya existe en BU, es necesario crear nueva tarjeta', 'Usuario ya existe');
                   }, 0);
                   break;
               default:
               setTimeout(function() {
                       toastr.options = {
                           closeButton: true,
                           progressBar: true,
                           showMethod: 'slideDown',
                           closeMethod: 'fadeOut',
                           timeOut: 5000
                       };
                       toastr.error(error.message, error.code);

                   }, 0);
           }


           return Result = false;
           // ...
         });
// fin de funcion
}

*/

     function uniqid() {
         var ts=String(new Date().getTime()), i = 0, out = '';
         for(i=0;i<ts.length;i+=2) {
            out+=Number(ts.substr(i, 2)).toString(36);
         }
         return ('t'+out);
         }


    </script>
@endsection
