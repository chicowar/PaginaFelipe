@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

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
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

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
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>

                                <button type="button" class="btn btn-primary" onclick="consultar()">
                                    prueba
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


<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>

  <script>
//import * as admin from "node_modules/firebase-admin";



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


    function NuevoUsuario(email,password){
        firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        // [START_EXCLUDE]
        if (errorCode === 'auth/wrong-password') {
          alert('Wrong password.');
        } else {
          alert(errorMessage);
        }

        // [END_EXCLUDE]
      });



/*
      admin.auth().getUser('AXJ3paUYG4WI6t4cGasIkcWAIVq2')
        .then(function(userRecord) {
          // See the UserRecord reference doc for the contents of userRecord.
          console.log("Successfully fetched user data:", userRecord.toJSON());
        })
        .catch(function(error) {
          console.log("Error fetching user data:", error);
        });
*/
      firebase.auth().getUserByEmail(email)
      .then(function(userRecord) {
        // See the tables above for the contents of userRecord
        console.log("Successfully fetched user data:", userRecord.toJSON());
      })
      .catch(function(error) {
        console.log("Error fetching user data:", error);
      });

      console.log('userId');

       console.log(1);
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
