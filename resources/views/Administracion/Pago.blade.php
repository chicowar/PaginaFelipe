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

  <input type="date" id="hoy" name="hoy" value="{{ $today }}" style="display:none;" />
<div class="container">

    <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
<fieldset>

<!-- Form Name -->
<legend>Resumen Tarjetas</legend>

<div class="row">
  <div class="form-group col-md-6">
    <label class="col-md-6 control-label">Creadas:</label>
    <div class="col-md-6 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><button onclick="ver_creadas();"><i class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Ver tarjetas creadas"></i></button></span>
        <input  name="creadas" id="creadas" placeholder="#Numero" class="form-control" step=”1″ type="number"disabled>

    </div>
  </div>
</div>



  <div class="form-group col-md-6">
    <label class="col-md-6 control-label">Vencidas:</label>
    <div class="col-md-6 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><button onclick="ver_vencidas();"><i class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Ver tarjetas vencidas"></i></button></span>
        <input  name="vencidas" id="vencidas" placeholder="#Numero" class="form-control" step=”1″ type="number"disabled>

      </div>
   </div>

  </div>


</div>

</fieldset>

    </div><!-- /.container -->


    <div class="container">

    <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
    <fieldset>
    <legend id="detalleLegend">Detalle Tarjetas Creadas</legend>


    <table class="table table-striped table-bordered table-hover dataTables-example"  id="detailTable">
                        <thead>
                        <tr>
                          <th>E-Mail</th>
                          <th>Usuario</th>
                          <th>Vencimiento</th>
                          <th>Vencida</th>


                        </tr>
                        </thead>
                        <tbody id="detailTableBody">


                        </tbody>

    </table>




    </fieldset>

    </div>


    <script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>

    <script type="text/javascript">

$(document).ready(function(){

jsShowWindowLoad();

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



     $("#creadas").val(snapshot.numChildren());
     $("#detailTableBody").empty();

        var i = 0,  o = 0

        snapshot.forEach(function(childSnapshot) {

        var childData = childSnapshot.val();


        if(childData.bloqueada == "1"){
                  $("#detailTableBody").append('<tr class="gradeX"><strong><td>'+childData.email+
                  '</td><td>'+childData.username+'</td><td>'+childData.vencimiento+'</td><td> <i class="fa fa-check" aria-hidden="true"></i></td></strong></tr>');

        } else {
          $("#detailTableBody").append('<tr class="gradeX"><strong><td>'+childData.email+
          '</td><td>'+childData.username+'</td><td>'+childData.vencimiento+'</td><td> <i class="fa fa-times" aria-hidden="true"></i></td></strong></tr>');
              }



        if(childData.vencimiento <= $('#hoy').val()){
         o = o + 1;
        }
        $('#vencidas').val(o);





    });
jsRemoveWindowLoad();
  });


});

 function ver_creadas(){


      jsShowWindowLoad();

      const empresallave = $('#empresauid').val();

      const db = firebase.database();
      //const tarjetas = firebase.database().ref("usuarios").orderbychild('empresauid');
      const rootRef = firebase.database().ref();
      const usuariosRef = rootRef.child('usuarios');

      const empresauidnodo   = usuariosRef.orderByChild('empresauid');

      const query   = empresauidnodo.equalTo(''+empresallave+'');

      query.once("value")

      .then(function(snapshot) {

       $("#detailTableBody").empty();

        var i = 0,  o = 0

        snapshot.forEach(function(childSnapshot) {

          var childData = childSnapshot.val();

if(childData.bloqueada == "1"){
          $("#detailTableBody").append('<tr class="gradeX"><strong><td>'+childData.email+
          '</td><td>'+childData.username+'</td><td>'+childData.vencimiento+'</td><td> <i class="fa fa-check" aria-hidden="true"></i></td></strong></tr>');

} else {
  $("#detailTableBody").append('<tr class="gradeX"><strong><td>'+childData.email+
  '</td><td>'+childData.username+'</td><td>'+childData.vencimiento+'</td><td> <i class="fa fa-times" aria-hidden="true"></i></td></strong></tr>');
      }
       });
       jsRemoveWindowLoad();

       $("#detalleLegend").empty();

       $("#detalleLegend").append('Detalle Tarjetas Creadas');
       });

}


function ver_vencidas(){



     jsShowWindowLoad();

     const empresallave = $('#empresauid').val();

     const db = firebase.database();
     //const tarjetas = firebase.database().ref("usuarios").orderbychild('empresauid');
     const rootRef = firebase.database().ref();
     const usuariosRef = rootRef.child('usuarios');

     const empresauidnodo   = usuariosRef.orderByChild('empresauid');

     const query   = empresauidnodo.equalTo(''+empresallave+'');

     query.once("value")

     .then(function(snapshot) {

      $("#detailTableBody").empty();

       var i = 0,  o = 0

       snapshot.forEach(function(childSnapshot) {

         var childData = childSnapshot.val();

                 if(childData.bloqueada == "1"){
                   $("#detailTableBody").append('<tr class="gradeX"><strong><td>'+childData.email+
                   '</td><td>'+childData.username+'</td><td>'+childData.vencimiento+'</td><td> <i class="fa fa-check" aria-hidden="true"></i></td></strong></tr>');
                 }


       });
});

$("#detalleLegend").empty();

$("#detalleLegend").append('Detalle Tarjetas Vencidas');

jsRemoveWindowLoad();

}






function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();


}

function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();

    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = "Procesando la información<br>Espere por favor";

    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;

    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;

    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/9 - parseInt(height)/9;//Se utiliza en el margen superior, para centrar

   //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div></br>"+
    "<div id='rendimientocampcargando' class='cargando'><div>.</div><div>.</div><div>.</div><div>A</div><div>R</div><div>E</div><div>P</div><div>S</div><div>E</div></div></br></div>";

        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);

        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"

        //asignamos el div que bloquea
        $("#WindowLoad").append(input);

        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();

        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);

}






    </script>


    <style>
    #WindowLoad
    {
        position:fixed;
        top:0px;
        left:0px;
        z-index:3200;
        filter:alpha(opacity=65);
       -moz-opacity:65;
        opacity:0.65;
        background:#999;
    }


     .cargando {
       position:absolute;
       width:100%;
       height:100%;
       left:30%;
       top:40%;
       margin-left:-400px;
       overflow:visible;
       -webkit-user-select:none;
       cursor:default;
     }

     .cargando div {
       position:absolute;
       width:30%;
       height:30%;
       opacity:0;
       font-family:Helvetica, Arial, sans-serif;
       -webkit-animation:move 3s linear infinite;
       -webkit-transform:rotate(180deg);
       color:#000000;
     }

     .cargando div:nth-child(2) {-webkit-animation-delay:0.1s;}
     .cargando div:nth-child(3) {-webkit-animation-delay:0.2s;}
     .cargando div:nth-child(4) {-webkit-animation-delay:0.3s;}
     .cargando div:nth-child(5) {-webkit-animation-delay:0.4s;}
     .cargando div:nth-child(6) {-webkit-animation-delay:0.5s;}
     .cargando div:nth-child(7) {-webkit-animation-delay:0.6s;}
     .cargando div:nth-child(8) {-webkit-animation-delay:0.7s;}
     .cargando div:nth-child(9) {-webkit-animation-delay:0.8s;}

     @keyframes move {
       0% {
         left:0;
         opacity:0;
       }
         35% {
             left: 41%;
             -webkit-transform:rotate(0deg);
             opacity:1;
         }
         65% {
             left:59%;
             -webkit-transform:rotate(0deg);
             opacity:1;
         }
         100% {
             left:100%;
             -webkit-transform:rotate(-180deg);
             opacity:0;
         }
     }

     @-webkit-keyframes move {
         0% {
             left:0;
             opacity:0;
         }
         35% {
             left:41%;
             -webkit-transform:rotate(0deg);
             transform:rotate(0deg);
             opacity:1;
         }
         65% {
             left:59%;
             -webkit-transform:rotate(0deg);
             transform:rotate(0deg);
             opacity:1;
         }
         100% {
             left:100%;
             -webkit-transform:rotate(-180deg);
             transform:rotate(-180deg);
             opacity:0;
         }
     }

    </style>

@endsection
