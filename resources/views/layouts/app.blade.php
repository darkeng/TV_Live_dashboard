<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TV Live') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('vendor/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="{{ asset('vendor/js/all.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}" defer></script>
    
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">{{ __('Toggle navigation') }}</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="brand-logo" class="navbar-brand" href="{{ route('dashboard.home') }}">
                        <img src="{{ asset('storage/img/logo_nbg.png') }}">
                        <span>{{ config('app.name', 'TV-Live') }}</span>
                    </a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-nav navbar-top-links navbar-right">
                    <!-- /.Link -->
                    @auth
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                            <span>{{ Auth::user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Opciones</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    @endauth
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
                @auth
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                            </li>
                            @role('admin')
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Usuarios<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Nuevo usuario</a>
                                    </li>
                                    <li>
                                        <a href="#">Todos los usuarios</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            @endrole
                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Lineas<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ route('line.showaddform') }}">Nueva linea</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('line.showextendform') }}">Extender suscripcion</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('line.manage') }}">Administrar lineas</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-gear fa-fw"></i> Cuenta</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
                @endauth
        </nav>
        <!-- /.navbar-static-top -->

        <!-- Page Content -->
        @auth
        <div id="page-wrapper">
        @else
        <div class="container-fluid">
        @endauth
            @yield('content')
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
@stack('scripts')
</body>
</html>
