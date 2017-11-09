@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="css/mistarjetas.css">

    <div id="wrapper">
  <div class="col-md-4">
      <form action="" class="search-form">
          <div class="form-group has-feedback">
          <label for="search" class="sr-only">Search</label>
          <input type="text" class="form-control" name="search" id="search" placeholder="search">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
      </form>
  </div>
</div>
<div id="page-wrapper">
  <div class="col-md-12">
      <div class="contact-box">
          <div class="col-sm-4">
              <div class="text-center">
                  <img alt="image" class="img-circle m-t-xs img-responsive" src="img/a4.jpg">
                  <div class="m-t-xs font-bold" id="puesto" >Sales manager</div>
                  <input type="text" name="recibidas" id = "recibidas" value="" style="display: none;" >
                  <input type="text" name="Enviadas" id = "Enviadas" value="" style="display: none;" >
              </div>
          </div>
          <div class="col-sm-8">
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
                    <div>
                        <canvas id="barChart" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

<script src="js/Chart.min.js"></script>
<script src="js/chartjs-demo.js"></script>



@endsection
