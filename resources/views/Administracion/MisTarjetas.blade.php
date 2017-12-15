@extends('layouts.app')

@section('content')
<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<link rel="stylesheet" href="css/mistarjetas.css">

<div  class="">
    <div class="row">
  <div class="col-sm-3 col-md-3 col-lg-3">
        <div class="nav-side-menu">
            <div class="brand">Brand Logo</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                         <p id="mistarjetas">Mis Tarjetas <a data-toggle="modal" data-target="#modalUpload"><i style="color:white;" class="glyphicon glyphicon-plus"></i></a></p>
                    <div id="usuariosadd">

                    </div>
                    <!-- Parar submenus
                    <li data-toggle="collapse" data-target="#new" class="collapsed">
                        <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="new">
                        <li><a href="new1">New New 1</a></li>
                        <li><a href="new2">New New 2</a></li>

                    </ul>
                    -->
                </ul>
            </div>
        </div>
  </div>
<div class="col-sm-8 col-md-9 col-lg-9">
  <div class="col-md-12">
      <div class="contact-box">
          <div class="col-sm-4">
              <div class="text-center">
                  <img id="imagenuser" alt="image" class="img-circle m-t-xs img-responsive" src="img/a4.jpg">
                  <div class="m-t-xs font-bold" id="puesto" >Sales manager</div>
                  <input type="text" name="recibidas" id = "recibidas" value="" style="display: none;" >
                  <input type="text" name="Enviadas" id = "Enviadas" value="" style="display: none;" >
              </div>
          </div>
          <div class="col-sm-8">
              <input type="hidden" name="uidtarjeta" id='uidtarjeta'>
              <h3><strong id="nombreu">Michael Zimber</strong></h3>
              <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
              <address>
                  <strong>Twitter, Inc.</strong><br>
                  795 Folsom Ave, Suite 600<br>
                  San Francisco, CA 94107<br>
                  <abbr title="Phone">P:</abbr> (123) 456-7890
              </address>
          </div>
          <div class="clearfix"></div>
      </div>
  </div>
  <div class="col-md-12">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bar Chart Example</h5>
                    <div ibox-tools></div>
                </div>
                <div class="ibox-content">
                    <div id="barChartCont">
                        <canvas id="barChart" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
          <select class="chosen-select form-control required" id="eligegrupo" name="eligegrupo" required >
            <option ></option>
             <?php foreach ($grupos as $grupo): ?>
              <option value=<?=$grupo->id ?> ><?=$grupo->grupo ?></option>
             <?php endforeach ?>
          </select>
        </div>
    </div>
  </div>
  </div>
  </div>

  <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 class="modal-title">Crear nuevo grupo</h3>
            </div>
            <div class="modal-body">
              <form class="" action="/grupo/store" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                      <h2><label for="Usuario" class="control-label">Grupo:</label></h2>
                      <input class="form-control input-lg" id="grupo" type="Text" placeholder="Nombre del grupo" name="grupo" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success" id="btnobjetivo"><i class="glyphicon glyphicon-floppy-save"></i><br>Agregar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCloseUpload"><i class="glyphicon glyphicon-remove"></i><br>Cerrar</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>

<script src="js/Chart.min.js"></script>
<script src="js/chartjs-demo.js"></script>



@endsection
