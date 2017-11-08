@extends('layouts.app')

@section('content')
    <link href="css/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<div class="container">
  <div class="row">

    <form class="well form-horizontal" action="/storeTarjeta" method="post"  id="tarjetaForm" onsubmit="return NuevaTarjetax();">
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
<legend>Crear Usuario y Tarjeta</legend>

<!-- Text input-->

  <div class="form-group">
    <label class="col-md-4 control-label">Nombre</label>
    <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="first_name" placeholder="Nombre" id="Nombre" class="form-control"  type="text" required>
      </div>
    </div>
  </div>




<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label">E-Mail</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email" placeholder="E-Mail" id="email" class="form-control"  type="text" required>
    </div>
  </div>
</div>


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label"># Telefonico</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
  <input name="phone" placeholder="8455551212" id="phone" class="form-control" type="number" required>
    </div>
  </div>
</div>

<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label">Puesto</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
  <input name="puesto" id="puesto" placeholder="Puesto" class="form-control"  type="text" required>
    </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label">Ubicacion de sucursal</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>

        <select class="form-control" name="ubicacionselect" id="ubicacionselect" required>
          <option value="">Elige una ubicacion</option>
          @foreach ($ubicaciones as $ubicacion)
          <option value="{{ $ubicacion->id}}">{{ $ubicacion->direccion }} </option>
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
    <button type="submit" class="btn btn-warning" onclick="return NuevaTarjetax();" >Guardar datos de tarjeta <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->

    <script src="js/tarjeta.js"></script>
    <script type="text/javascript">


    $(document).ready(function() {

    $('#tarjetaid').val(uniqid());

      $("#ubicacionselect").change(function() {
        //$('#proveedor').val('0').find('option[value="0"]‌​').remove();
        $("#ubicacionselect option[value='']").remove();

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

  firebase.auth().createUserWithEmailAndPassword($('#email').val(), '1234567')
  .then(function(user){

    $('#uid').val(user.uid);

    var uploader = document.getElementById('uploader');
    var file = $('#files')[0].files[0]
    var storageRef = firebase.storage().ref('usuarios/'+user.uid+'/'+file.name);
    var task = storageRef.put(file);
    task.on('state_changed', function progress(snapshot) {
      var percentage = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
      uploader.value = percentage;

    }, function error(err) {
      setTimeout(function() {
              toastr.options = {
                  closeButton: true,
                  progressBar: true,
                  showMethod: 'slideDown',
                  timeOut: 4000
              };
              toastr.error(error.message, error.code);

          }, 0);
      return false;

    },function complete() {


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



        }).catch(function(error) {
            //Handle error

            setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.error(error.message, error.code);

                }, 0);

            return false;

        });


      formulario.submit();

    });

  }).catch(function(error) {
  // Handle Errors here.

  setTimeout(function() {
          toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: 'slideDown',
              timeOut: 4000
          };
          toastr.error(error.message, error.code);

      }, 0);


  return Result = false;
  // ...
});





/*
    var file = $('#files')[0].files[0]
    if (file){
      var imagen = file.name;
      // Create a reference with an initial file path and name
      var storage = firebase.storage();
      // Create a reference from a Google Cloud Storage URI
      var storageRef = storage.refFromURL('gs://felipe-29121.appspot.com/tarjetas/')

      var hijo = document.getElementById('empresauid').value+'/'+document.getElementById('archivoname').value;
      storageRef.child(hijo).getDownloadURL().then(function(url) {
        // `url` is the download URL for 'images/stars.jpg'

      // Or inserted into an <img> element:
      var img = document.getElementById('myimg');


      img.src = url;

      }).catch(function(error) {
        // Handle any errors
      });
    }
    else{
      var imagen = "";
    }
  // Initialize Firebase
  /*
  var config = {
    apiKey: "AIzaSyD7fnd4lstP7klHMW8kpGFAtI0iYWWcodg",
    authDomain: "felipe-29121.firebaseapp.com",
    databaseURL: "https://felipe-29121.firebaseio.com",
    projectId: "felipe-29121",
    storageBucket: "felipe-29121.appspot.com",
    messagingSenderId: "428661649011"
  };
  firebase.initializeApp(config);

    var empresaId =  $('#id_compania').val();

   // validamos formulario
    var formulario = document.getElementById("tarjetaForm");
       if (formulario.checkValidity()){
       // se escribe nodo en usuario

      alert('tarjetas/'+$('#empresauid').val()+'/'+ $('#tarjetaid').val());

       firebase.database().ref('tarjetas/'+$('#empresauid').val()+'/'+ $('#tarjetaid').val()).set({
         username: $('#Nombre').val(),
         email: $('#email').val(),
         phone: $('#phone').val(),
         puesto: $('#puesto').val(),
         ubicacion: $('#ubicacion').val(),
         imagen_de_perfil : imagen,
       });

       // se hace submit formulario
      //   formulario.submit();
      setTimeout(function() {
              toastr.options = {
                  closeButton: true,
                  progressBar: true,
                  showMethod: 'slideDown',
                  timeOut: 4000
              };
              toastr.success('Valida los que los campos esten completos', 'Usuario no guardado');

          }, 0);
    //  formulario.submit();
    return false;
       }
           else {
             setTimeout(function() {
                     toastr.options = {
                         closeButton: true,
                         progressBar: true,
                         showMethod: 'slideDown',
                         timeOut: 4000
                     };
                     toastr.error('Valida los que los campos esten completos', 'Usuario no guardado');

                 }, 0);
          }
          */
         }




     function uniqid() {
         var ts=String(new Date().getTime()), i = 0, out = '';
         for(i=0;i<ts.length;i+=2) {
            out+=Number(ts.substr(i, 2)).toString(36);
         }
         return ('t'+out);
         }


    </script>
@endsection
