<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BeYou</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/form-elements.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">

    <!-- Javascript -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrapvalidator.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>

    <!-- Toastr -->
    <script src="js/toastr/toastr.min.js"></script>
    <!-- Toastr style -->
    <link href="/css/toastr/toastr.min.css" rel="stylesheet">

    <!-- Firebase -->

    <script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyD7fnd4lstP7klHMW8kpGFAtI0iYWWcodg",
    authDomain: "felipe-29121.firebaseapp.com",
    databaseURL: "https://felipe-29121.firebaseio.com",
    projectId: "felipe-29121",
    storageBucket: "felipe-29121.appspot.com",
    messagingSenderId: "428661649011"
  };
  firebase.initializeApp(config);
</script>



</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top" style=" background-color: #2B98F0;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @auth
                        <a class="navbar-brand" href="{{ url('/home') }}">
                          <div class="">
                            <img src="/img/BU.jpeg" alt="Home" height="25" width="25" class="img-rounded" id="myimgInicio">
                            Inicio
                          </div>
                        </a>
                    @else
                        <a class="navbar-brand" href="{{ url('/') }}">
                          Inicio
                        </a>
                    @endauth
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registrarse</a></li>
                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="glyphicon glyphicon-cog"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="{{ url('/') }}">Bandeja habilita</a></li>
                                    <li>
                                  <li><a href="{{ route('usuarioAdmin') }}">Usuarios Administrativos</a></li>
                                    <li>
                                      <a href="{{ url('/Empresa') }}">
                                        Mi Empresa
                                      </a>
                                      <a href="{{ url('/CrearTarjeta') }}">
                                        Crear Tarjeta
                                      </a>
                                      <a href="{{ url('/Pago') }}">
                                        Pago
                                      </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>
