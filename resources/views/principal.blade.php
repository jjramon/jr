<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colegio Evangelico Shaddai">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Colegio Evangelico Shaddai">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/icono.png">
    <!--Titulo de la pagina -->
    <title>Colegio Evangelico Shaddai</title>
    <!-- css -->

    <link href="css/plantilla.css" rel="stylesheet">
    

</head>

<body class="sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div class="app header-fixed" id="app">
        <header class=" app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
            <span class="navsuperior navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="nav navbar-nav d-md-down-none">
                <li class="nav-item px-3 ">
                    <a class="navsuperior nav-link " href="#"><h3>{{$colegio->Nombre}}</h3></a>
                </li>
                <li class="nav-item px-3 ">
                    <a class="navsuperior nav-link " href="#"><h5>{{$colegio->Direccion}}</h5></a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="img/avatars/6.jpg" class="img-avatar" alt="">
                        <span class="d-md-down-none">{{Auth::user()->usuario}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <strong>Cuenta</strong>
                        </div>
                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Cerrar sesión</a>
                    
                        <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display:none;">
                            {{ csrf_field()}}
                        </form>
                    </div>
                </li>
            </ul>
        </header>

        <div class="app-body">
            @if(Auth::check())
                @if(Auth::user()->idRol == 1)
                    @include('/plantilla.sidebarAdmin')
                @elseif(Auth::user()->idRol == 2)
                    @include('/plantilla.sidebarPadre')
                @elseif(Auth::user()->idRol == 3)
                    @include('/plantilla.sidebarDocente')
                @elseif(Auth::user()->idRol == 4)
                    @include('/plantilla.sidebarSecretaria')
                @elseif(Auth::user()->idRol == 5)
                    @include('/plantilla.sidebarDireccion')
                @else
                @endif
            @endif



            <!-- Contenido Principal -->
            @yield('contenido')
            <!-- /Fin del contenido principal -->
        </div>   
    </div>

   
    <footer class="app-footer">
            <span> &copy; 2018</span>
            <span class="ml-auto">Desarrollado por Juan Ramón González Ramírez</a></span>
    </footer>     




    <!-- scripts -->
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>

</body>

</html>