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

  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <label class="control-label" ><FONT SIZE=22 color="cian">Compañia</FONT></label>
    </div>


  <!-- Text input-->

    <div class="form-group">
      <label class="col-md-4 control-label">Nombre</label>
      <div class="col-md-8 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input  name="nombre" id="nombre" placeholder="Nombre de la empresa" class="form-control"  type="text" value="{{$empresa->name}}">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Direccion</label>
        <div class="col-md-8 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
      <input name="direccion" id="direccion" placeholder="Domicilio de la empresa" class="form-control" type="text" value="{{$empresa->direccion}}">
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
  <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
  <input type="text" id="id" name="id" value="{{ Auth::user()->id }}" style="display:none;" />
  <input type="text" id="archivoname" name="archivoname" value="{{ Auth::user()->archivo }}" style="display:none;" />
  <input type="file" id="files" name="files" style="display:none;" />
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="button" onclick="storagenew()" class="btn btn-warning" >Guardar Cambios <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>



</fieldset>
</form>
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


    function storagenew(){


      console.log(4)
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
    </script>
@endsection
