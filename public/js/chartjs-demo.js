function  imagenuser(id,imagen){

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
  }).catch(function(error) {
    // Handle any errors
    console.log('hola3');
  });
}

var getusuario = firebase.database().ref('usuarios/BUY08JMkhKPnOjEagHsNiAZm9K73');
getusuario.on('value', function(datos) {
  $("#puesto").empty();
  $("#puesto").append(datos.val().puesto);
  $("#nombreu").empty();
  $("#nombreu").append(datos.val().username);
  $("#recibidas").val(datos.val().Recibidas);
  $("#Enviadas").val(datos.val().Enviadas);
  imagenuser(datos.val().id,datos.val().imagen_de_perfil);
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

var query = firebase.database().ref("usuarios").orderByKey();
query.once("value")
  .then(function(snapshot) {
    var eldiv = document.getElementById('usuariosadd');
    var arrayusers = '';
    snapshot.forEach(function(childSnapshot) {
      // key will be "ada" the first time and "alan" the second time
      var key = childSnapshot.key;
      // childData will be the actual contents of the child
      var childData = childSnapshot.val();
      arrayusers = arrayusers + '<a onclick="obtenernuevo(\''+ childData.id +'\')"><li><span class="glyphicon glyphicon-user"></span> '+childData.username+' </li></a>';
  });
  eldiv.innerHTML= arrayusers;
});

function obtenernuevo (usuarios){

  var getusuario = firebase.database().ref('usuarios/'+usuarios);
  getusuario.on('value', function(datos) {
    $("#puesto").empty();
    $("#puesto").append(datos.val().puesto);
    $("#nombreu").empty();
    $("#nombreu").append(datos.val().username);
    $("#recibidas").val(datos.val().Recibidas);
    $("#Enviadas").val(datos.val().Enviadas);
    imagenuser(datos.val().id,datos.val().imagen_de_perfil);
    $('#barChart').remove(); // this is my <canvas> element
    $('#barChartCont').append('<canvas id="barChart" height="140"><canvas>');
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
