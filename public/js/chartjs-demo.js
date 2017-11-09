

var getusuario = firebase.database().ref('usuarios/HNKDVxzrfyfrDiqo5b1ZCpNvWh53');
getusuario.on('value', function(datos) {
  $("#puesto").empty();
  $("#puesto").append(datos.val().Puesto);
  $("#nombreu").empty();
  $("#nombreu").append(datos.val().nombre);
  $("#recibidas").val(datos.val().Recibidas);
  $("#Enviadas").val(datos.val().Enviadas);

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
