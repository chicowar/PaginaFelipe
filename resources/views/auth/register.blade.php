@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="regform" onsubmit="return NuevoUsuario();">
                       <input id="id_compania" type="hidden" class="form-control" name="id_compania" value="{{ old('id_compania') }}" required>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" minlength="6" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirma Password</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control" name="password_confirmation" data-rule-equalTo="#password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn boton_personalizado">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/scripts.js"></script>

<style type="text/css">
  .boton_personalizado{
    color: #fff;
    background-color: #2b98f0;
    border-color: #2e6da4;
  }
</style>
<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>

  <script>

/*
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyD7fnd4lstP7klHMW8kpGFAtI0iYWWcodg",
      authDomain: "felipe-29121.firebaseapp.com",
      databaseURL: "https://felipe-29121.firebaseio.com",
      projectId: "felipe-29121",
      storageBucket: "felipe-29121.appspot.com",
      messagingSenderId: "428661649011"
    };
    firebase.initializeApp(config);
*/
  //  var admin = require("firebase-admin");
function consultar(){


var socket = io.connect('localhost:3000');


  socket.emit('chat message','hola mundo vista');

//  return false;




socket.on('chat message', function(msg){
  alert(msg);

});
}
    function updatefirebase(userId,name){
      firebase.database().ref('Users/' + userId).set({
         username: 'jona',
         email: 'Super',
         profile_picture : 'cayoquen'
       });
       console.log(1);
    }




    function NuevoUsuario(){
      // detenemos submit
        event.preventDefault();
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyD7fnd4lstP7klHMW8kpGFAtI0iYWWcodg",
        authDomain: "felipe-29121.firebaseapp.com",
        databaseURL: "https://felipe-29121.firebaseio.com",
        projectId: "felipe-29121",
        storageBucket: "felipe-29121.appspot.com",
        messagingSenderId: "428661649011"
      };
      firebase.initializeApp(config);

   // borramos si ya existe
     var empresaId =  $('#id_compania').val();
     if(empresaId != "")
     {
      firebase.database().ref('Empresa/'+empresaId).remove();
    }

    // asignamos nuevo valor de id empresa

      $('#id_compania').val(uniqid());
      var empresaId =  $('#id_compania').val();

    // validamos formulario
      var formulario = document.getElementById("regform");
        if (formulario.checkValidity()){
        // se escribe nodo en empresa

        firebase.database().ref('Empresa/'+empresaId).set(empresaId);

        // se hace submit formulario
          formulario.submit();

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
          }


    function uniqid() {
        var ts=String(new Date().getTime()), i = 0, out = '';
        for(i=0;i<ts.length;i+=2) {
           out+=Number(ts.substr(i, 2)).toString(36);
        }
        return ('d'+out);
        }

  </script>

  <script type="text/javascript" src="/nodejs/node_modules/socket.io-client/socket.io.js"></script>
  <script type="text/javascript" >
/*  var socket = io.connect('localhost:8000');
socket.on( 'connect' , function(){
      console.log('connected to a node server');
  });
  socket.on( 'db_results' , function ( data ) {
      // has lo que quieras hacer con tu datos de db
  });*/


  </script>

@endsection
