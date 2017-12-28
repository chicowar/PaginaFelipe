
$(document).ready(function(){
  $(".chosen-select").chosen({width: "100%"});

  $("#eligegrupo").change(function() {
    uidtarjeta = document.getElementById('uidtarjeta').value;
    gruponew = document.getElementById('eligegrupo').value;
      firebase.database().ref('usuarios/' + uidtarjeta).update({
         grupo: gruponew,
       });
  arbol();
  });

arbol();

  });


function  imagenuser(id,imagen){

  if (imagen == undefined)
  {
    var img2 = document.getElementById('myimg');
    img2.src = "/img/profile-icon-1.png";

    // Create a reference with an initial file path and name
    var storage = firebase.storage();
    // Create a reference from a Google Cloud Storage URI
    var storageRef = storage.refFromURL('gs://felipe-29121.appspot.com/usuarios')

    var hijo = 'default/default.png';
    storageRef.child(hijo).getDownloadURL().then(function(url) {
      // `url` is the download URL for 'images/stars.jpg'
    // Or inserted into an <img> element:
    var img = document.getElementById('imagenuser');
    img.src = url;
    }).catch(function(error) {

      });
  }

  else {

  // Create a reference with an initial file path and name
  var storage = firebase.storage();
  // Create a reference from a Google Cloud Storage URI
  var storageRef = storage.refFromURL('gs://felipe-29121.appspot.com/usuarios')

  var hijo = id+'/'+imagen;
  storageRef.child(hijo).getDownloadURL().then(function(url) {
    // `url` is the download URL for 'images/stars.jpg'
  // Or inserted into an <img> element:
  var img = document.getElementById('imagenuser');
  img.src = url;

  var img2 = document.getElementById('myimg');
  img2.src = url;
  }).catch(function(error) {
    // Handle any errors

    // Create a reference with an initial file path and name
    var storage = firebase.storage();
    // Create a reference from a Google Cloud Storage URI
    var storageRef = storage.refFromURL('gs://felipe-29121.appspot.com/usuarios')

    var hijo = 'default/default.png';
    storageRef.child(hijo).getDownloadURL().then(function(url) {
      // `url` is the download URL for 'images/stars.jpg'
    // Or inserted into an <img> element:
    var img = document.getElementById('imagenuser');
    img.src = url;
    
    var img2 = document.getElementById('myimg');
    img2.src = url;
    }).catch(function(error) {

      });

  });
}

}


function arbol()
{

var route = "Gruposshow";
$.get(route, function(res){

    const empresallave = [res[0].id_compania];

    const db = firebase.database();
    //const tarjetas = firebase.database().ref("usuarios").orderbychild('empresauid');
    const rootRef = firebase.database().ref();
    const usuariosRef = rootRef.child('usuarios');

    const empresauidnodo   = usuariosRef.orderByChild('empresauid');

    const query   = empresauidnodo.equalTo(''+empresallave+'');

  query.once("value")
    .then(function(snapshot) {

      var eldiv = document.getElementById('usuariosadd');
      var arrayusers = '';
      var arrayusers3 = [];
      for (var i = 0; i < res.length; i++) {

        arrayusers3[res[i].id] = {p:'<li data-toggle="collapse" data-target="#grupo'+ res[i].id +'" class="collapsed"><a href="#"><i class="fa fa-archive"></i> '+ res[i].grupo +' <span class="arrow"></span></a></li><ul class="sub-menu collapse" id="grupo'+ res[i].id +'">',
                          s:'',
                          t:'</ul>'
                          };
      }

      var i = 0
      snapshot.forEach(function(childSnapshot) {

        // key will be "ada" the first time and "alan" the second time
        var key = childSnapshot.key;

        if((i == 0) && ($("#uidtarjeta").val() == '')){
          $("#uidtarjeta").val(key);
          obtenernuevo ($("#uidtarjeta").val());

        }
        // childData will be the actual contents of the child
        var childData = childSnapshot.val();

        if(childData.grupo != null){
          arrayusers3[childData.grupo].s = arrayusers3[childData.grupo].s + '<a onclick="obtenernuevo(\''+ key +'\')"><li><span class="glyphicon glyphicon-user"></span> '+childData.username+' </li></a>';
        }else {
          arrayusers = arrayusers + '<a onclick="obtenernuevo(\''+ key +'\')"><li><span class="glyphicon glyphicon-user"></span> '+childData.username+' </li></a>';
        }
        i = i+1;

    });
    for (var i = 0; i < res.length; i++) {
      arrayusers = arrayusers + arrayusers3[res[i].id].p + arrayusers3[res[i].id].s + arrayusers3[res[i].id].t;
    }
    eldiv.innerHTML= arrayusers;

  });

});

}


function obtenernuevo (usuarios){

  var getusuario = firebase.database().ref('usuarios/'+usuarios);
  getusuario.on('value', function(datos) {
    // llenamos datos de la tarjeta
    $("#puesto").empty();
    $("#puesto").append(datos.val().puesto);
    $("#nombreu").empty();
    $("#nombreu").append(datos.val().username);
    $("#ubicau").empty();
    if(datos.val().ubicacion.length > 0)
    {
    $("#ubicau").append('<i class="fa fa-map-marker"></i> '+ datos.val().ubicacion);
    }
    $("#phoneu").empty();
    $("#phoneu").append('<i class="glyphicon glyphicon-phone"></i> '+ datos.val().phone);
    $("#whatsappu").empty();
    if(datos.val().whatsapp.length > 0)
    {
    $("#whatsappu").append('<i class="fa fa-whatsapp"></i> '+ datos.val().whatsapp);
    }
    $("#emailu").empty();
    $("#emailu").append('<i class="glyphicon glyphicon-envelope"></i> '+ datos.val().email);
    $("#recibidas").val(datos.val().Recibidas);
    $("#Enviadas").val(datos.val().Enviadas);
    $("#uidtarjeta").empty();
    $("#uidtarjeta").val(datos.key);
     // llenamos datos de la tarjeta en el modal de edicion
     $("#uid").empty();
     $("#uid").val(datos.key);
    $("#Nombre").val(datos.val().username);
    $("#puesto").val(datos.val().puesto);
    $("#email").val(datos.val().email);
    $("#phone").val(datos.val().phone);
    if(datos.val().whatsapp.length > 0)
    {
     $("#whatsapp").val(datos.val().whatsapp);
    }
    else {
      $("#whatsapp").val();
    }

    var select = document.getElementById('eligegrupomod');

    for ( var i = 0, l = select.options.length, o; i < l; i++ )
    {
      o = select.options[i];
      o.selected = false;

      if(o.value == datos.val().grupo)
      {
        o.selected = true;

      }
    }

    $("#eligegrupomod").trigger("chosen:updated");



    if(datos.val().ubicacion.length > 0)
    {
      $('#lat').val(datos.val().lat);
      $('#lng').val(datos.val().lng);

      var select = document.getElementById('ubicacionselect');

      for ( var i = 0, l = select.options.length, o; i < l; i++ )
      {
        o = select.options[i];
        o.selected = false;
        if(o.text.trim() == datos.val().ubicacion.trim())
        {
          o.selected = true;
        }
      }
        $("#ubicacionselect").trigger("chosen:updated");
    }
    else {
      $('#lat').val();
      $('#lng').val();

      var select = document.getElementById('ubicacionselect');

      for ( var i = 0, l = select.options.length, o; i < l; i++ )
      {
        o = select.options[i];
        o.selected = false;

        if(o.value == '')
        {
          o.selected = true;

        }
      }
        $("#ubicacionselect").trigger("chosen:updated");



    }


    imagenuser(usuarios,datos.val().imagen_de_perfil);

    var select = document.getElementById('eligegrupo');

    for ( var i = 0, l = select.options.length, o; i < l; i++ )
    {
      o = select.options[i];
      o.selected = false;

      if(o.value == datos.val().grupo)
      {
        o.selected = true;

      }
    }
    $("#eligegrupo").trigger("chosen:updated");

    $(function () {

        var barData = {
            labels: ["Recibidas", "Enviadas"],
            datasets: [
                {
                    label: "Enviadas",
                    fillColor: "rgba(043,152,240,0.5)",
                    strokeColor: "rgba(043,152,240,0.8)",
                    highlightFill: "rgba(043,152,240,0.75)",
                    highlightStroke: "rgba(043,152,240,1)",
                    data: [$("#recibidas").val(), $("#Enviadas").val()]
                }
            ]
        };

        var barOptions = {
            scaleBeginAtZero: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            barShowStroke: true,
            barStrokeWidth: 2,
            barValueSpacing: 5,
            barDatasetSpacing: 1,
            responsive: true,
        }


        var ctx = document.getElementById("barChart").getContext("2d");
        var myNewChart = new Chart(ctx).Bar(barData, barOptions);

    });
  });

}

function abremodal(){

  $("#editatarjeta").toggle();
  $("#editatarjeta").show();

}


function cierramodal()
{

  $("#editatarjeta").toggle();

}
