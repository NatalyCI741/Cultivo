<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png')}}" type="image/x-icon">
    <title>Bienvenido</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style (Updated to Blue and Green) -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Estilo de la barra de navegación */
        .navbar {
            background-color: #2A9D8F; /* Verde */
        }

        .navbar a {
            color: #ffffff !important;
        }

        .navbar a:hover {
            color: #264653 !important;
        }

        /* Estilo para el sidebar */
        .main-sidebar {
            background-color: #264653; /* Azul oscuro */
        }

        .nav-link {
            color: #e9c46a !important; /* Amarillo */
        }

        .nav-link:hover {
            background-color: #2A9D8F; /* Verde */
            color: #ffffff;
        }

        .nav-treeview {
            background-color: #f1faee; /* Fondo claro */
        }

        /* Estilo de los botones */
        .btn-primary {
            background-color: #2A9D8F;
            border-color: #264653;
        }

        .btn-primary:hover {
            background-color: #264653;
            border-color: #2A9D8F;
        }

        /* Estilo de los formularios */
        .form-control {
            border-color: #264653;
            background-color: #f1faee;
        }

        .form-control:focus {
            border-color: #2A9D8F;
            box-shadow: 0 0 0 0.2rem rgba(42, 157, 143, 0.25);
        }

        .dropdown-menu {
            background-color: #264653;
            color: white;
        }

        .dropdown-item:hover {
            background-color: #2A9D8F;
        }
    </style>
</head>

<body>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-success-green elevation-4">
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <br><br><br><br>

                    <!-- Unidades Productivas -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" style="color: rgb(57, 194, 204);">
                            <i class="fas fa-pencil-alt" style="color: rgb(29, 209, 206);"></i> &nbsp;
                            <p>
                                Inventario
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('herramienta.create') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Ingreso</p>
                                </a>
                            </li>
                            <li class="nav-item"><a href="{{ route('herramienta.index') }}" class="nav-link text-dark">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>Listas</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- /.sidebar -->
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
</body>

</html>
