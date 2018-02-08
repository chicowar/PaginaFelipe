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

@if($errors->any())
    <div class="alert alert-warning" role="alert">
       @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
      @endforeach
    </div>
@endif </br>

<div class="container">

    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend>Usuarios Administracion</legend>

<div class="row">

      <div class="col-lg-12">
          <div class="panel panel-red">
              <div class="panel-heading">
                  Usuarios
                  <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalUpload"><i class="glyphicon glyphicon-floppy-save"></i></button>
              </div>
          <div class="panel-body">
            <div class="row">
              <div class="table-responsive">
                  <table width="100%" class="table table-responsive table-striped table-bordered table-hover" id="tblUsers">
                    <thead style='background-color: #868889; color:#FFF'>
                      <tr>
                        <th>  <div class="th-inner sortable both"><h3>    Nombre  </h3></div></th>
                        <th>  <div class="th-inner sortable both"><h3>    Email </h3> </div></th>

                        <th>  <div class="th-inner sortable both"><h3>   Modificar  </h3></div></th>
                        <th>  <div class="th-inner sortable both"><h4>   Eliminar </h3> </div></th>
                      </tr>
                    </thead>
                    <!-- aqui va la consulta a la base de datos para traer las filas se hace desde el controlador-->
                    <tbody id="myTable">
                      <?php foreach ($usuario as $usuarios): ?>
                      <tr>
                        <td>  <?=$usuarios->name?></td>
                        <td>  <?=$usuarios->email?></td>
                        <td>
                          <button type="button" onclick="Editar(this);" class="btn btn-primary" data-toggle="modal" data-target="#modaledit" value="{{ $usuarios->id }}"><i class="glyphicon glyphicon-edit"></i>  </button>
                        </td>
                        <td>
                          <form class="" action="/usuarios/destroy/{{ $usuarios->id }}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger" id="btnpro<?=$usuarios->id?>" style="font-family: Arial;" onclick="
                              return confirm('Estas seguro de eliminar el Usuario <?=$usuarios->name?>?')" <?php if(Auth::user()->id == $usuarios->id  ){echo(' disabled="disabled" data-toggle="tooltip" data-placement="top" title="No es posible borrar el usuario con el que se esta loggeado" ');}?>><i class="fa fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
              </div>
              <div class="col-md-12 text-center">
                <ul class="pagination pagination-lg pager" id="myPager"></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

</fieldset>
</form>
    </div><!-- /.container -->


    <!-- Modal para agregar Usuarios-->
        <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">ALTA DE USUARIOS</h2>
                    </div>
                    <div class="modal-body">
                      <form class="" action="/usuarios/store" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12">
                              <label style="font-weight: bold">(*) Nombre:</label>
                              <input type="text" class="form-control" id="name" name="name" required="" value="{{ old('name') }}"/>
                          </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label style="font-weight: bold">(*) Correo:</label>
                                <input type="text" class="form-control" id="email" name="email" required="" value="{{ old('email') }}"/>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label style="font-weight: bold">(*) Contraseña: &nbsp;&nbsp;&nbsp;</label><input type="checkbox" tabindex="500" id="chkVerPassword" onclick="mostrarpas()"/><span style="font-size:12px">Ver</span>
                                <input type="password" class="form-control" id="password" name="password" required="" value="{{ old('email') }}"/>
                            </div>
                            <input type="text" id="empresauid" name="empresauid" value="{{ Auth::user()->id_compania }}" style="display:none;" />

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

        <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">EDITAR USUARIO</h2>
                    </div>
                    <div class="modal-body">
                      <form id="fileinfo" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <input type="hidden" id="eid">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12">
                              <label style="font-weight: bold">(*) Nombre:</label>
                              <input type="text" class="form-control" id="enombre" name="enombre" value=""/>
                          </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label style="font-weight: bold">Correo:</label>
                                <input type="text" class="form-control" id="eemail" name="eemail" value="" />
                            </div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                  <label style="font-weight: bold">Password:</label>
                                  <label style="font-weight: bold">Si queda vacio permanece la misma contraseña</label>
                                  <input type="password" class="form-control" id="epassword" name="epassword"/>
                              </div>

                        </div>


                            <div class="modal-footer">

                                <a class="btn btn-primary" id="actualizar" style="font-family: Arial;"><i class="glyphicon glyphicon-edit"></i><br>Editar</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCloseUpload2"><i class="glyphicon glyphicon-remove"></i><br>Cerrar</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
        </div>

    <script type="text/javascript">

    $.fn.pageMe = function(opts){
        var $this = this,
            defaults = {
                perPage: 7,
                showPrevNext: false,
                hidePageNumbers: false
            },
            settings = $.extend(defaults, opts);

        var listElement = $this;
        var perPage = settings.perPage;
        var children = listElement.children();
        var pager = $('.pager');

        if (typeof settings.childSelector!="undefined") {
            children = listElement.find(settings.childSelector);
        }

        if (typeof settings.pagerSelector!="undefined") {
            pager = $(settings.pagerSelector);
        }

        var numItems = children.size();
        var numPages = Math.ceil(numItems/perPage);

        pager.data("curr",0);

        if (settings.showPrevNext){
            $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
        }

        var curr = 0;
        while(numPages > curr && (settings.hidePageNumbers==false)){
            $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
            curr++;
        }

        if (settings.showPrevNext){
            $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
        }

        pager.find('.page_link:first').addClass('active');
        pager.find('.prev_link').hide();
        if (numPages<=1) {
            pager.find('.next_link').hide();
        }
          pager.children().eq(1).addClass("active");

        children.hide();
        children.slice(0, perPage).show();

        pager.find('li .page_link').click(function(){
            var clickedPage = $(this).html().valueOf()-1;
            goTo(clickedPage,perPage);
            return false;
        });
        pager.find('li .prev_link').click(function(){
            previous();
            return false;
        });
        pager.find('li .next_link').click(function(){
            next();
            return false;
        });

        function previous(){
            var goToPage = parseInt(pager.data("curr")) - 1;
            goTo(goToPage);
        }

        function next(){
            goToPage = parseInt(pager.data("curr")) + 1;
            goTo(goToPage);
        }

        function goTo(page){
            var startAt = page * perPage,
                endOn = startAt + perPage;

            children.css('display','none').slice(startAt, endOn).show();

            if (page>=1) {
                pager.find('.prev_link').show();
            }
            else {
                pager.find('.prev_link').hide();
            }

            if (page<(numPages-1)) {
                pager.find('.next_link').show();
            }
            else {
                pager.find('.next_link').hide();
            }

            pager.data("curr",page);
          	pager.children().removeClass("active");
            pager.children().eq(page+1).addClass("active");

        }
    };

    $(document).ready(function(){

      $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:10});

      $("#actualizar").click(function(){
        var value = $("#eid").val();
        var route = "/usuarios/edit/"+value+"";
        var token = $("#token").val();
        var fd = new FormData(document.getElementById("fileinfo"));

        $.ajax({
          url: route,
          headers: {'X-CSRF_TOKEN': token},
          type: 'post',
          data: fd,
          processData: false,  // tell jQuery not to process the data
          contentType: false,
          success: function(){
            alert("Cambios guardados correctamente");
            location.reload();
          }
        });
      });

    // termina document ready
    });
    // termina document ready

    function Editar(btn){
        var route = "/usuarios/"+btn.value+"/edit";

        $.get(route, function(res){
          $("#enombre").val(res.name);
          $("#eid").val(res.id);
          $("#eemail").val(res.email);
          $("#epassword").val("");
        });
      }

    function mostrarpas(){
      if(document.getElementById("chkVerPassword").checked)
      {
          $("#password").prop("type", "text");
      }
      else {
        $("#password").prop("type", "password");

      }
    };

    </script>
@endsection
