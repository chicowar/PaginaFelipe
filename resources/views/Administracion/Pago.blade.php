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
<legend>Pago</legend>

<div class="row">
  <div class="form-group">
    <label class="col-md-4 control-label">Numero de tarjetas para comprar</label>
    <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input  name="numero" id="numero" placeholder="#Numero" class="form-control" step=”2″ type="number">
      </div>
    </div>
  </div>

  <div class="form-group">
    <button type="button" class="btn btn-warning" >Proceder al pago</button>
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


    </script>
@endsection
