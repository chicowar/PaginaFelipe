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
    <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
<fieldset>

<!-- Form Name -->
<legend>Pago</legend>

<div class="row">
  <div class="form-group col-md-6">
    <label class="col-md-4 control-label">Tarjetas creadas:</label>
    <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="creadas" id="creadas" placeholder="#Numero" class="form-control" step=”1″ type="number">
      </div>
    </div>
  </div>

  <div class="form-group col-md-6">
    <label class="col-md-4 control-label">Tarjetas pagadas:</label>
    <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="pagadas" id="pagadas" placeholder="#Numero" class="form-control" step=”1″ type="number">
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="form-group col-md-6">
    <label class="col-md-4 control-label">Tarjetas vencidas:</label>
    <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="vencidas" id="vencidas" placeholder="#Numero" class="form-control" step=”1″ type="number">
      </div>
    </div>
  </div>

  <div class="form-group col-md-6">
    <label class="col-md-4 control-label">Tarjetas x pagar:</label>
    <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="xpagar" id="xpagar" placeholder="#Numero" class="form-control" step=”1″ type="number">
      </div>
    </div>
  </div>

</div>


  <div class="form-group">
    <button type="button" class="btn btn-warning" >Proceder al pago</button>
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




    const empresallave = $('#empresauid').val();

    const db = firebase.database();
    //const tarjetas = firebase.database().ref("usuarios").orderbychild('empresauid');
    const rootRef = firebase.database().ref();
    const usuariosRef = rootRef.child('usuarios');

    const empresauidnodo   = usuariosRef.orderByChild('empresauid');

    const query   = empresauidnodo.equalTo(''+empresallave+'');

  query.once("value")
    .then(function(snapshot) {
     console.log(snapshot);
     var i = 0;
      $("#creadas").val(snapshot.numChildren());

      snapshot.forEach(function(childSnapshot) {
        console.log(childSnapshot.val());
        var childData = childSnapshot.val();
        if(childData.pagada == "1"){
          i = i + 1;
          $('#pagadas').val(i);
        }


    });





  });




    </script>
@endsection
