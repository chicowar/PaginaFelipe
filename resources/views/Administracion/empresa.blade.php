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
      <a  id="archivobtn" type="button" value="Seleccionearchivo" ><output id="list"><img src="/img/companyDefault.png" alt="Compañia" height="142" width="142" class="img-rounded"></output></a>
      <progress id="uploader" value="0" max="100">0%</progress>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <label class="control-label" ><FONT SIZE=22 color="cian">Compañia</FONT></label>
    </div>
  </div>


  <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
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
