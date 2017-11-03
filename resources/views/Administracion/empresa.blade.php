@extends('layouts.app')

@section('content')

  <script type="text/javascript">var centreGot = false;</script>{!!$map['js']!!}

    <link href="css/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<div class="container">

    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend>Mi Empresa</legend>

<div class="row">

  <!-- Text input-->
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <a  id="archivobtn" type="button" value="Seleccionearchivo" ><output id="list"><img src="/img/companyDefault.png" alt="Compañia" height="142" width="142" class="img-rounded" id="myimg"></output></a>
      <progress id="uploader" value="0" max="100">0%</progress>
    </div>
  </div>



  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
  <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
  <input type="text" id="id" name="id" value="{{ Auth::user()->id }}" style="display:none;" />
  <input type="text" id="archivoname" name="archivoname" value="{{ Auth::user()->archivo }}" style="display:none;" />
  <input type="file" id="files" name="files" style="display:none;" />



</form>

<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="form-group">
    <label class="control-label" ><FONT SIZE=22 color="cian">Compañia</FONT></label>
  </div>


<!-- Text input-->

  <div class="form-group">

    <br>
    <label class="col-md-4 control-label">Nombre</label>
    <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        <input onkeypress="return pulsar(event)"  name="nombre" id="nombre" placeholder="Nombre de la empresa" class="form-control"  type="text" value="{{$empresa->name}}">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label"></label>
    <div class="col-md-4">
      <button type="button" onclick="guardarnombre()" class="btn btn-warning" >Guardar nombre de empresa <span class="glyphicon glyphicon-send"></span></button>
    </div>
  </div>


</div>
</div>

<form class="well form-horizontal" action="/empresa/storeubicacion/1" method="post"  id="ubica_form">
<div class="row">
  <div class="form-group">
    <label class="control-label" ><FONT SIZE=22 color="cian">Agregar ubicaci&oacute;n</FONT></label>
  </div>
  <div class="col-md-10 inputGroupContainer">
    <div class="col-md-4">
    <label class="col-md-12 control-label">Buscar ubicacion</label>
    <label class="col-md-12 control-label">Ubicacion actual del puntero</label>
    </div>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
      <input onkeypress="return pulsar(event)"  name="nombre" id="searchmap" placeholder="Busca ubicacion" class="form-control"  type="text" value="" >
       <div class="col-md-12" id="address"name="address"></div>
    </div>
  </div>

  {!!$map['html']!!}

   <input type="hidden" id="lat" name="lat">
   <input type="hidden" id="lng" name="lng">
   <input type="hidden" id="direccion" name="direccion">
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <!--<button type="button" onclick="guardaubicacion()" class="btn btn-warning" >Guardar ubicacion <span class="glyphicon glyphicon-send"></span></button>-->
    <button type="submit"class="btn btn-warning" >Guardar ubicacion <span class="glyphicon glyphicon-send"></span></button>

  </div>
</div>
</form>
</fieldset>


    </div><!-- /.container -->

    <script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>

    <script type="text/javascript">

    var config = {
      apiKey: "AIzaSyD7fnd4lstP7klHMW8kpGFAtI0iYWWcodg",
      authDomain: "felipe-29121.firebaseapp.com",
      databaseURL: "https://felipe-29121.firebaseio.com",
      projectId: "felipe-29121",
      storageBucket: "felipe-29121.appspot.com",
      messagingSenderId: "428661649011"
    };
    firebase.initializeApp(config);

    // Create a reference with an initial file path and name
    var storage = firebase.storage();
    // Create a reference from a Google Cloud Storage URI
    var storageRef = storage.refFromURL('gs://felipe-29121.appspot.com/Empresa')

    var hijo = document.getElementById('empresauid').value+'/'+document.getElementById('archivoname').value;
    storageRef.child(hijo).getDownloadURL().then(function(url) {
      // `url` is the download URL for 'images/stars.jpg'

    // Or inserted into an <img> element:
    var img = document.getElementById('myimg');
    img.src = url;
    }).catch(function(error) {
      // Handle any errors
    });

    function updatefirebase(userId){
      firebase.database().ref('Users/' + userId).set({
         username: 'jona',
         email: 'Super',
         profile_picture : 'cayoquen'
       });

       console.log(2);
    }


    function guardarnombre(){


    }

    function guardaubicacion(){

      var value = $("#id").val();
      var route = "/empresa/storeubicacion/"+value+"";
      var token = $("#token").val();
      var fd = new FormData(document.getElementById("ubica_form"));

      $.ajax({
        url: route,
        headers: {'X-CSRF_TOKEN': token},
        type: 'post',
        data: fd,
        processData: false,  // tell jQuery not to process the data
        contentType: false,
        success: function(){
          setTimeout(function() {
                  toastr.options = {
                      closeButton: true,
                      progressBar: true,
                      showMethod: 'slideDown',
                      timeOut: 4000
                  };
                  toastr.success('Se ha añadido nueva localizacion', 'Alta de usuario');

              }, 0);
        },
        error: function(){
        }
      });
      }



    var uploader = document.getElementById('uploader');
    var fileButton =         document.getElementById('files');
    var Empresauid = document.getElementById('empresauid').value;
    fileButton.addEventListener('change', function(e){
      var value = $("#id").val();
      var route = "/empresa/edit/"+value+"";
      var token = $("#token").val();
      var fd = new FormData(document.getElementById("contact_form"));

      $.ajax({
        url: route,
        headers: {'X-CSRF_TOKEN': token},
        type: 'post',
        data: fd,
        processData: false,  // tell jQuery not to process the data
        contentType: false,
        success: function(){
        }
      });


    var file = e.target.files[0];
    var storageRef = firebase.storage().ref('Empresa/'+Empresauid+'/'+file.name);
    var task = storageRef.put(file);
    task.on('state_changed', function progress(snapshot) {
      var percentage = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
      uploader.value = percentage;

    }, function error(err) {


    },function complete() {

    });
    });


    $(document).ready(function() {


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

      function pulsar(e) {
        tecla = (document.all) ? e.keyCode :e.which;
        return (tecla!=13);
      }

    </script>
@endsection
