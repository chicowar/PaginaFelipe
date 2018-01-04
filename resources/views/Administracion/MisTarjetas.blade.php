@extends('layouts.app')

@section('content')
<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<link rel="stylesheet" href="css/mistarjetas.css">

<link rel="stylesheet" href="css/style.css">

<link href="css/animate.css" rel="stylesheet">

<div  class="">
    <div class="row">
  <div class="col-sm-3 col-md-3 col-lg-3">
        <div class="nav-side-menu">
            <div class="brand">x</div>
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
  <div class="contact-box" data-toggle="tooltip" data-placement="top" title="Da click para editar">
                   <a id="myLink" href="#"  data-toggle="modal" data-target="#editatarjeta">
                   <div class="col-sm-4">
                       <div class="text-center">
                         <img id="imagenuser" alt="image" class="img-circle m-t-xs img-responsive" src="/img/profile-icon-1.png">
                         <div class="m-t-xs font-bold" id="puestou" ></div>
                         <input type="text" name="recibidas" id = "recibidas" value="" style="display: none;" >
                         <input type="text" name="Enviadas" id = "Enviadas" value="" style="display: none;" >
                       </div>
                   </div>
                   <div class="col-sm-8">
                     <input type="hidden" name="uidtarjeta" id='uidtarjeta'>
                     <h3><strong id="nombreu"></strong></h3>
                     <h4><strong id="emailu"></strong></h4>
                     <h4><strong id="phoneu"></strong></h4>
                     <h4><strong id="whatsappu"></strong></h4>
                     <address><p id="ubicau"></p></address>
                     </div>
                   <div class="clearfix"></div>
              </a>
     </div>
</div>

  <div class="col-md-12">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Resumen de interacciones:</h5>
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
          <div class="ibox-title">
              <h5>Cambiar de grupo </h5>
              <div ibox-tools></div>
          </div>
          <select class="chosen-select form-control required" id="eligegrupo" name="eligegrupo" required >
             <?php foreach ($grupos as $grupo): ?>
              <option value=<?=$grupo->id ?> ><?=$grupo->grupo ?></option>
             <?php endforeach ?>
          </select>
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



  <div class="modal inmodal" id="editatarjeta" name="editatarjeta" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="" style="overflow-y: scroll; max-height:100%;  margin-top: 50px; margin-bottom:50px;">
          <div class="modal-content animated flipInX">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" onclick="cierramodal();"><span aria-hidden="true"><bold>&times;</bold></span><span class="sr-only">Close</span></button>
                <legend>Editar Tarjeta</legend>
              </div>
              <div class="modal-body">

                <form role="form" data-toggle="validator"class="well form-horizontal" action="/editTarjeta" method="post"  id="tarjetaForm">
                <fieldset>
                  {{ csrf_field() }}


                  <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />
                  <input type="text" id="id" name="id" value="{{ Auth::user()->id }}" style="display:none;" />
                  <input type="text" id="archivoname" name="archivoname" value="{{ Auth::user()->archivo }}" style="display:none;" />
                  <input type="text" id="tarjetaid" name="tarjetaid" value="" style="display:none;" />
                  <input type="text" id="ubicacion" name="ubicacion" value="" style="display:none;" />
                  <input type="text" id="lat" name="lat" value="" style="display:none;" />
                  <input type="text" id="lng" name="lng" value="" style="display:none;" />
                  <input type="text" id="uid" name="uid" value="" style="display:none;" />
                  <input type="text" id="enviadas" name="enviadas" value="" style="display:none;" />
                  <input type="text" id="recibidas" name="recibidas" value="" style="display:none;" />
                  <input type="text" id="favoritas" name="favoritas" value="" style="display:none;" />
                  <input type="text" id="imagen_de_perfil" name="imagen_de_perfil" value="" style="display:none;" />

                <!-- Form Name -->

                <!-- Text input-->

                  <div class="form-group">
                    <label class="col-md-4 control-label">Nombre *</label>
                    <div class="col-md-4 inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input  name="first_name" placeholder="Nombre" id="Nombre" class="form-control"  type="text" required>
                      </div>
                    </div>
                  </div>

                  <!-- Text input-->
                         <div class="form-group">
                    <label class="col-md-4 control-label">Puesto *</label>
                      <div class="col-md-4 inputGroupContainer">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                    <input name="puesto" id="puesto" placeholder="Puesto" class="form-control"  type="text" required>
                      </div>
                    </div>
                  </div>


                <!-- Text input-->
                       <div class="form-group">
                  <label class="col-md-4 control-label">E-Mail *</label>
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input name="email" placeholder="E-Mail" id="email" class="form-control"  type="text" disabled>
                    </div>
                  </div>
                </div>


                <!-- Text input-->

                <div class="form-group">
                  <label class="col-md-4 control-label">Telefono de contacto *</label>
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                  <input name="phone" placeholder="8455551212" id="phone" class="form-control" type="number" required>
                    </div>
                  </div>
                </div>

                <!-- Text input-->

                <div class="form-group">
                  <label class="col-md-4 control-label">Whatsapp</label>
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>
                  <input name="whatsapp" placeholder="8455551212" id="whatsapp" class="form-control" type="number">
                    </div>
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">Ubicacion de sucursal</label>
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>

                        <select class="chosen-select form-control" name="ubicacionselect" id="ubicacionselect">
                          <option value="">Elige una ubicacion</option>
                          @foreach ($ubicaciones as $ubicacion)
                          <option value="{{ $ubicacion->id}}">{{ $ubicacion->direccion }}</option>
                          @endforeach
                        </select>

                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label">Grupo:</label>
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select class="chosen-select form-control required" id="eligegrupomod" name="eligegrupomod" required >
                           <?php foreach ($grupos as $grupo): ?>
                            <option value=<?=$grupo->id ?> ><?=$grupo->grupo ?></option>
                           <?php endforeach ?>
                        </select>

                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label">Fotografia:</label>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <center>
                      <a id="archivobtn" type="button" value="Seleccionearchivo" ><output id="list"><img src="/img/profile-icon-1.png" alt="Foto" height="142" width="142" class="img-rounded" id="myimg"  data-toggle="tooltip" data-placement="top" title="Da click para cambiar imagen"></output></a>
                    <progress id="uploader" value="0" max="100">0%</progress>
                  </center>
                  </div>
                    <input type="file" id="files" name="files" style="display:none;" />
                </div>

                </div>


                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                  <div class="col-md-4">
                    <button id="submittarjeta" name="submittarjeta" type="submit" class="btn btn-warning"  >Guardar datos de tarjeta <span class="glyphicon glyphicon-send"></span></button>
                  </div>
                </div>
                <center><label class="col-md-12 control-label">* Campos obligatorios</label></center>
                </fieldset>
                </form>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal" id="closebuscatelefono" name="closebuscatelefono" onclick="cierramodal();" >Close</button>
              </div>
          </div>
      </div>
  </div>

<script src="js/Chart.min.js"></script>
<script src="js/chartjs-demo.js"></script>
<script>
     $(document).ready(function(){
         $('.contact-box').each(function() {
             animationHover(this, 'pulse');
         });
     });
     window.animationHover = function(element, animation){
         element = $(element);
         element.hover(
             function() {
                 element.addClass('animated ' + animation);
             },
             function(){
                 //wait for animation to finish before removing classes
                 window.setTimeout( function(){
                     element.removeClass('animated ' + animation);
                 }, 2000);
             });
     };

 </script>


@endsection
