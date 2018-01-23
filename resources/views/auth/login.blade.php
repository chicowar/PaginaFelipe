@extends('layouts.app')

@section('content')

<!-- Switchery -->
<script src="js/switchery.js"></script>

<script>
  $(document).ready(function(){

    var elem_1 = document.querySelector('.js-switch1');
    var switchery_1 = new Switchery(elem_1, { color: '#2b98f0' });

});
</script>
<link href="css/switchery.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
<div class="panel panel-default">
            <div class="panel-heading">                  <h3>Inicio de sesion</h3>
                                <p>Ingresa email y contraseña para ingresar:</p></div>

                    <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-username form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label class="control-label">

                                        <input type="checkbox"  class="js-switch1" name="remember" {{ old('remember') ? 'checked' : '' }}> <font color='black'>  Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                          <button type="submit" class="btn boton_personalizado">
                              Login
                          </button>
                      <a class="btn boton_personalizado" href="{{ route('password.request') }}">
                        Forgot Your Password?
                      </a>
                  </form>
                </div>
                    </div>
        </div>
    </div>
</div>


<style type="text/css">
  .boton_personalizado{
    color: #fff;
    background-color: #2b98f0;
    border-color: #2e6da4;
  }
</style>


    <script src="js/scripts.js"></script>
@endsection
