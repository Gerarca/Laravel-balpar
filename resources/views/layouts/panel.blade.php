<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets_template/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ url('assets_template/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ config('app.name', 'Panel Porta') }}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ url('assets_template/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ url('assets_template/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ url('assets_template/demo/demo.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ url('assets_template_extra/select2/select2.min.css') }}">
  <link href="{{ url('assets_template/css/specific.css') }}" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="brown" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="{{route('panel.index')}}" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="{{ url('assets_cliente/img/logo.jpg') }}">
          </div>
        </a>
        <a href="{{route('panel.index')}}" class="simple-text logo-normal">
          Pink Garden
          <!-- <div class="logo-image-big">
            <img src="{{ url('assets_template/img/logo-big.png') }}">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            @if(Auth::user() && strlen(Auth::user()->image)>=1)
              <img src="{{ url('uploads/'.Auth::user()->image) }}" />
            @else
              <img src="{{ url('assets_template/img/default-avatar.png') }}" />
            @endif
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                {{ Auth::user()->name }}
                <b class="caret"></b>
              </span>
            </a>
            <div class="clearfix"></div>
            <div class="{{ (Request::is('panel/editar_perfil') || Request::is('panel/opciones'))?'collapse show':'collapse'}} " id="collapseExample">
              <ul class="nav">
                <li class="{{ (Request::is('panel/editar_perfil'))?'active':''}}">
                  <a href="{{ route('editar_perfil') }}">
                    <span class="sidebar-mini-icon">EP</span>
                    <span class="sidebar-normal">Editar Perfil</span>
                  </a>
                </li>
                @if (isset(Auth::user()->roles()->first()->name) && Auth::user()->hasRole('Administrador'))
                  <li class="{{ (Request::is('panel/opciones'))?'active':''}}">
                    <a href="{{ url('panel/opciones') }}">
                      <span class="sidebar-mini-icon">O</span>
                      <span class="sidebar-normal">Opciones</span>
                    </a>
                  </li>
                @endif
                <li>
                  <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="sidebar-mini-icon">CS</span>
                    <span class="sidebar-normal">Cerrar Sesión</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        @include('partials.panel-sidebar')

      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      @include('partials.panel-header')
      <!-- End Navbar -->
      <!-- <div class="panel-header">

  <canvas id="bigDashboardChart"></canvas>


</div> -->
      @yield('content')
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.porta.com.py/" target="_blank">Porta Agencia Web</a>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, hecho con <i class="fa fa-heart heart"></i> en <a href="https://www.porta.com.py/" target="_blank">Porta Agencia Web</a>
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
  <!--   Core JS Files   -->
  <script src="{{ url('assets_template/js/core/jquery.min.js') }}"></script>
  <script src="{{ url('assets_template/js/core/popper.min.js') }}"></script>
  <script src="{{ url('assets_template/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ url('assets_template/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ url('assets_template/js/plugins/moment.min.js') }}"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="{{ url('assets_template/js/plugins/bootstrap-switch.js') }}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{ url('assets_template/js/plugins/sweetalert2.min.js') }}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{ url('assets_template/js/plugins/jquery.validate.min.js') }}"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ url('assets_template/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ url('assets_template/js/plugins/bootstrap-selectpicker.js') }}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ url('assets_template/js/plugins/bootstrap-datetimepicker.js') }}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{ url('assets_template/js/plugins/jquery.dataTables.min.js') }}"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ url('assets_template/js/plugins/bootstrap-tagsinput.js') }}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ url('assets_template/js/plugins/fullcalendar.min.js') }}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ url('assets_template/js/plugins/jquery-jvectormap.js') }}"></script>
  <!--  Plugin for the Bootstrap Table -->
  <script src="{{ url('assets_template/js/plugins/nouislider.min.js') }}"></script>
  <!-- Chart JS -->
  <script src="{{ url('assets_template/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ url('assets_template/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ url('assets_template/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript') }}"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ url('assets_template/demo/demo.js') }}"></script>
  <script src="{{ url('assets_template_extra/select2/select2.min.js') }}"></script>
  <script src="{{ url('assets_template_extra/select2/es.js') }}"></script>

  @yield('especifico');
</body>

</html>
