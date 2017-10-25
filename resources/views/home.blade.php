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
    <div class="row">
      <a href="{{ url('/Empresa') }}">
        <div class="col-md-4">
          <div class="widget style1 navy-bg">
              <div class="row">
                  <div class="col-xs-4">
                      <i class="fa fa-cloud fa-5x"></i>
                  </div>
                  <div class="col-xs-8 text-right">
                      <span> Mi Empresa </span>
                      <h2 class="font-bold">26'C</h2>
                  </div>
              </div>
          </div>
        </div>
      </a>
      <a href="{{ url('/CrearTarjeta') }}">
        <div class="col-md-4">
          <div class="widget style1 lazur-bg">
              <div class="row">
                  <div class="col-xs-4">
                      <i class="fa fa-envelope-o fa-5x"></i>
                  </div>
                  <div class="col-xs-8 text-right">
                      <span> Crear Tarjeta </span>
                      <h2 class="font-bold">260</h2>
                  </div>
              </div>
          </div>
        </div>
      </a>

      <a href="{{ url('/MisTarjetas') }}">
        <div class="col-md-4">
          <div class="widget style1 yellow-bg">
              <div class="row">
                  <div class="col-xs-4">
                      <i class="fa fa-music fa-5x"></i>
                  </div>
                  <div class="col-xs-8 text-right">
                      <span>  Lista de Tarjetas </span>
                      <h2 class="font-bold">12</h2>
                  </div>
              </div>
          </div>
        </div>
      </a>

      </div>
    </div>
</div>
@endsection
