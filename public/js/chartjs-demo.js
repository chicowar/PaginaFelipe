
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


$("#ubicacionselect").change(function() {
  //$('#proveedor').val('0').find('option[value="0"]‌​').remove();
  //$("#ubicacionselect option[value='']").remove();

  $('#ubicacion').val($('#ubicacionselect option:selected').text());

  var id = $('#ubicacionselect').val();
  var route = "/storetarjeta/ubicacionget/"+ $('#ubicacionselect').val();

  $.get(route, function(res){

    $('#lat').val(res.lat);

    $('#lng').val(res.lng);

    });
 });





$('#tarjetaForm').bootstrapValidator({
// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later

feedbackIcons: {
   valid: 'glyphicon glyphicon-ok',
   invalid: 'glyphicon glyphicon-remove',
   validating: 'glyphicon glyphicon-refresh'
},
submitHandler: function(validator, form, submitButton) {

event.preventDefault();

EditaTarjetax();

  $('#tarjetaForm').data('bootstrapValidator').resetForm();


/*
  var bv = form.data('bootstrapValidator');
  // Use Ajax to submit form data
  $.post(form.attr('action'), form.serialize(), function(result) {
      console.log(result);
  }, 'json');

*/


},
fields: {
   first_name: {
       validators: {
               stringLength: {
               min: 2,
               message: 'Es necesario ingresar el nombre'
           },
               notEmpty: {
               message: 'Es necesario ingresar el nombre'
           }
       }
   },

   email: {
       validators: {
           notEmpty: {
               message: 'Es necesario ingresar el correo electronico'
           },
           emailAddress: {
               message: 'Por favor ingresa una direccion de correo valida'
           }
       }
   },
   phone: {
       validators: {
           notEmpty: {
               message: 'Por favor ingresa un numero de telefono a 10 digitos'
           },
           stringLength: {
                     min: 10,
                     max: 10,
                     message: 'El telefono debe ser a 10 digitos (lada + numero)'
                 },


       }
   },
   whatsapp: {
       validators: {

           stringLength: {
                     min: 10,
                     max: 10,
                     message: 'El numero debe ser a 10 digitos o dejar vacio si no se desea utilizar whatsapp'
                 },


       }
   },

   puesto: {
       validators: {
            stringLength: {
               min: 2,
               message: 'Es necesario ingresar el puesto'
           },
           notEmpty: {
               message: 'Es necesario ingresar el puesto'
           }
       }
   },



   }
})
      .on('success.form.bv', function(e) {
          // Prevent form submission
          e.preventDefault();

          // Get the form instance
          var $form = $(e.target);

          // Get the BootstrapValidator instance
          var bv = $form.data('bootstrapValidator');

/*
          // Use Ajax to submit form data
          $.post($form.attr('action'), $form.serialize(), function(result) {
              // ... Process the result ...
          }, 'json');*/
      });
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
    $("#puestou").empty();
    $("#puestou").append(datos.val().puesto);
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
    $("#enviadas").val(datos.val().enviadas);
    $("#recibidas").val(datos.val().recibidas);
    $("#favoritas").val(datos.val().favoritas);





    if(datos.val().whatsapp.length > 0)
    {
     $("#imagen_de_perfil").val(datos.val().imagen_de_perfil);
    }
    else {
      $("#imagen_de_perfil").val();
    }



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





         function EditaTarjetax(){

           // nuevo codigo
           // detenemos submit

           event.preventDefault();


           var formulario = document.getElementById("tarjetaForm");


          // se creo el login de firebase obtenemos el uid


             var uploader = document.getElementById('uploader');
             var file =  $('#files')[0].files[0]
             var validafile = $('#files').val();

             if(validafile != ''){
               var filename = file.name;
             }
             else {
               var filename = ''
             }



            // validar si se cargo archivo
            // si no se carga imagen en el formulario
            // no se ejecuta el codigo hasta el mensaje else de imagen

             if(validafile != '')
             {

               var storageRef = firebase.storage().ref('usuarios/'+$("#uid").val()+'/'+filename);
               var task = storageRef.put(file);
               task.on('state_changed', function progress(snapshot) {
                 var percentage = (snapshot.bytesTransferred/snapshot.totalBytes)*100;
                 uploader.value = percentage;

               }, function error(err) {
              // si se genera error al cargar el archivo da mensaje de error y elimina login de firebase

                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             timeOut: 5000
                         };
                         toastr.error('Verifica la imagen cargada', 'Error en carga de archivo');

                     }, 0);

                 return false;

               },function complete() {
                 console.log('se guardo archivo');
                 setTimeout(function() {
                         toastr.options = {
                             closeButton: true,
                             progressBar: true,
                             showMethod: 'slideDown',
                             timeOut: 5000
                         };
                         toastr.success('Guardada imagen de tarjeta', 'Carga de imagen correcta');

                     }, 0);
               });



               // equivale al else imagen
               // aqui entra si ya se genero el login en firebase
               // y se guardo correctamente el archivobt
               // aqui se genera el nodo de la tarjeta
               firebase.database().ref('usuarios/'+$("#uid").val()).update({
                 username: $('#Nombre').val(),
                 email: $('#email').val(),
                 phone: $('#phone').val(),
                 puesto: $('#puesto').val(),
                 ubicacion: $('#ubicacion').val(),
                 lat:  $('#lat').val(),
                 lng:  $('#lng').val(),
                 imagen_de_perfil : filename,
                 empresauid: $('#empresauid').val(),
                 whatsapp: $('#whatsapp').val(),
                 Enviadas: $("#enviadas").val(),
                 Recibidas: $("#recibidas").val(),
                 Favoritas: $("#favoritas").val(),
                 Publico: 1,
                 grupo: $('#eligegrupomod').val(),
                 id: $("#uid").val(),


             }).catch(function(error) {
               console.log('error al crear nodo');
                 //Handle error
                 // aqui entra si se genero un error al crear el nodo de tarjeta en firebase
                 // se debe borrar el archivo
                 // se debe borrar el login


             });

           formulario.submit();

             }


             else {

               // equivale al else imagen
               // la unica diferencia es que no genera nodo imagen_de_perfil para evitar errores en la app
               // aqui entra si ya se genero el login en firebase
               // y se guardo correctamente el archivobt
               // aqui se genera el nodo de la tarjeta
               firebase.database().ref('usuarios/'+$("#uid").val()).update({
                 username: $('#Nombre').val(),
                 email: $('#email').val(),
                 phone: $('#phone').val(),
                 puesto: $('#puesto').val(),
                 ubicacion: $('#ubicacion').val(),
                 lat:  $('#lat').val(),
                 lng:  $('#lng').val(),
                 empresauid: $('#empresauid').val(),
                 whatsapp: $('#whatsapp').val(),
                 Enviadas: $("#enviadas").val(),
                 Recibidas: $("#recibidas").val(),
                 Favoritas: $("#favoritas").val(),
                 Publico: 1,
                 grupo: $('#eligegrupomod').val(),
                 id: $("#uid").val(),


             }).catch(function(error) {
               console.log('error al crear nodo');
                 //Handle error
                 // aqui entra si se genero un error al crear el nodo de tarjeta en firebase
                 // se debe borrar el archivo
                 // se debe borrar el login





             });

           formulario.submit();
}


}


$('#archivobtn').click(function () {
    $("#files").click();
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

     function uniqid() {
         var ts=String(new Date().getTime()), i = 0, out = '';
         for(i=0;i<ts.length;i+=2) {
            out+=Number(ts.substr(i, 2)).toString(36);
         }
         return ('t'+out);
         }
