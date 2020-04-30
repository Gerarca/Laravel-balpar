<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title', '') Balpar S.A.</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{url('assets_front/images/favicon.png')}}"/>
  <meta name="description" content="Innovación para un país en expansión. Calidad en pesaje industrial y comercial, equipos para supermercados y cepillería industrial.">

  <link rel="stylesheet" type="text/css" href="{{url('assets_front/vendor/bootstrap/css/bootstrap.min.css')}}">
  <script src="https://kit.fontawesome.com/0ae1380cc5.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/fonts/themify/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/fonts/elegant-font/html-css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/vendor/animate/animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/vendor/css-hamburgers/hamburgers.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/vendor/animsition/css/animsition.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/vendor/select2/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/vendor/slick/slick.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/css/owl.carousel.min.css')}}">
  {{-- css --}}
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/css/util.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/css/main.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/css/estilos.css?v=1.3')}}">

</head>
<body class="animsition">

  <header class="header1">
    <div class="container-menu-header">
      <div class="topbar">
        <div class="topbar-social">
          <a href="https://www.facebook.com/Balanzas-Paraguayas-SA-Balpar-848894218561129/" target="_blank" class="topbar-social-item fab fa-facebook-f"></a>
          <a href="https://www.instagram.com/balparpy/" target="_blank" class="topbar-social-item fab fa-instagram"></a>
          <a href="#" class="topbar-social-item fab fa-linkedin"></a>
        </div>
        <div class="topbar-child2">
          <span class="topbar-links d-none d-lg-block">
            <a href="{{url('assets_front/public/ejemplo.pdf')}}" download><i class="fas fa-file-download"></i> Descargar Catálogo</a>
          </span>
          <span class="topbar-phone">
            <a href="tel:021 511 475"><i class="fas fa-phone"></i> 021 511 475</a>
          </span>
        </div>
      </div>
      <div class="wrap_header container px-0">
        <a href="{{route('front.index')}}" class="logo">
          <img src="{{url('assets_front/images/logo.png')}}" alt="Logo" style="max-height: 25px;">
        </a>
        <div class="wrap_menu wrap-side-menu">
          <nav class="menu">
            <ul class="main_menu">
              <li>
                <a href="{{route('front.index')}}">Inicio</a>
              </li>
              <li>
                <a href="{{route('front.nosotros')}}">Nosotros</a>
              </li>
              <li class="has-menu">
                <a href="javascript:void(0)">Productos</a>
                <ul class="sub_menu">
                  <li><a href="{{route('front.catalogo')}}">Ejemplo 1</a></li>
                  <li><a href="{{route('front.catalogo')}}">Ejemplo 2</a></li>
                  <li><a href="{{route('front.catalogo')}}">Ejemplo 3</a></li>
                </ul>
              </li>
              <li class="has-menu">
                <a href="javascript:void(0)">Servicios</a>
                <ul class="sub_menu">
                  <li><a href="{{route('front.servicio_tecnico')}}">Servicio Técnico</a></li>
                  <li><a href="{{route('front.servicio_tecnico')}}">Ejemplo 2</a></li>
                  <li><a href="{{route('front.servicio_tecnico')}}">Ejemplo 3</a></li>
                </ul>
              </li>
              <li>
                <a href="{{route('front.contacto')}}">Contacto</a>
              </li>
              <li class="d-lg-none">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download><i class="fas fa-file-download"></i> Descargar Catálogo</a>
              </li>
            </ul>
          </nav>
        </div>
        {{-- Header Icons --}}
        <div class="header-icons">
          {{-- Header search --}}
          <div class="header-wrapicon header-wrapicon1">
            <i class="fas fa-search header-icon1 js-show-header-dropdown"></i>
            <div class="header-cart header-dropdown search-dropdown">
              <div class="search-product pos-relative bo4 of-hidden">
                <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Buscar">
                <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4 btn-search-toggle">
                  <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
          <span class="linedivide1"></span>
          {{-- Header cart --}}
          <div class="header-wrapicon header-wrapicon2">
            <i class="fas fa-receipt header-icon1 js-show-header-dropdown"></i>
            <div class="header-cart header-dropdown">
              <ul class="header-cart-wrapitem">
                <li class="header-cart-item">
                  <div class="header-cart-item-img">
                    <img src="{{url('assets_front/images/prod1.jpg')}}">
                  </div>
                  <div class="header-cart-item-txt">
                    <a href="{{route('front.producto')}}" class="header-cart-item-name">
                      Nombre Producto
                    </a>
                    <span class="header-cart-item-info">Cantidad: 1</span>
                  </div>
                </li>

                <li class="header-cart-item">
                  <div class="header-cart-item-img">
                    <img src="{{url('assets_front/images/prod1.jpg')}}">
                  </div>
                  <div class="header-cart-item-txt">
                    <a href="{{route('front.producto')}}" class="header-cart-item-name">
                      Nombre Producto
                    </a>
                    <span class="header-cart-item-info">Cantidad: 1</span>
                  </div>
                </li>
              </ul>
              <div class="header-cart-buttons">
                <div class="w-100 pt-3">
                  <a href="{{route('front.presupuesto')}}" class="btn btn-primary flex-c-m size1 s-text1 trans-0-4">
                    Solicitar Presupuesto
                  </a>
                </div>
              </div>
            </div>
          </div>
          {{-- btn menu mobile --}}
          <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>

  @yield('content')

  <footer class="p-t-45 p-b-20 p-l-45 p-r-45">
    <div class="container">
      <div class="row flex-w">
        <div class="col-md-4 py-2 flex-column">
          <a href="{{route('front.index')}}"><img src="{{url('assets_front/images/logo.png')}}" style="height:30px;"></a>
          <ul>
            <li class="p-b-9 m-t-20">
              <a href="https://goo.gl/maps/UFVu7vSabQt3WCTW8" target="_blank" class="s-text7">
                <i class="fas fa-map-marker-alt" aria-hidden="true"></i> Av. Madame Lynch esq. Soriano Gonzalez - Asunción, Paraguay
              </a>
            </li>
            <li class="p-b-9">
              <a href="tel:021 511 475" class="s-text7">
                <i class="fas fa-phone" aria-hidden="true"></i> 021 511 475
              </a>
            </li>
          </ul>
          <div class="flex-m my-4">
            <a href="https://www.facebook.com/Balanzas-Paraguayas-SA-Balpar-848894218561129/" target="_blank" class="fs-18 p-r-20 fab fa-facebook-f"></a>
            <a href="https://www.instagram.com/balparpy/" target="_blank" class="fs-18 p-r-20 fab fa-instagram"></a>
          </div>
          <ul>
            <li class="p-b-9">
              <a href="{{route('front.nosotros')}}" class="s-text7">
                Nosotros
              </a>
            </li>
            <li class="p-b-9">
              <a href="{{route('front.servicio_tecnico')}}" class="s-text7">
                Servicio Técnico
              </a>
            </li>
            <li class="p-b-9">
              <a href="{{route('front.contacto')}}" class="s-text7">
                Contacto
              </a>
            </li>
          </ul>

        </div>
        <div class="col-md-4 py-2">
          <h4 class="s-text12 p-b-30">
            Instagram
          </h4>
          <!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/6c1b742b1cc252a9b9af0411d70879cc.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
        </div>
        <div class="col-md-4 py-2">
          <h4 class="s-text12 p-b-30">
            Testimonios
          </h4>
          <div class="testimonio-box">
            <form class="" action="{{ route('cargar.testimonio') }}" method="POST">
              @csrf
              <h5 class="mb-2">Dejá tu testimonio</h5>
              <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="nombre" required placeholder="Nombre">
              </div>
              <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="testimonio" required placeholder="Testimonio"></textarea>
              <div class="">
                <button type="submit" class="btn btn-primary flex-c-m sizefull s-text1 trans-0-4 w-100">
                  Enviar Testimonio
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-12 py-2">
          <div class="t-center p-l-15 p-r-15">
            <div class="text-center">
              <a href="https://www.porta.com.py/" target="_blank"><img src="{{url('assets_front/images/porta_logo.png')}}" alt="Porta Agencia Web" style="height: 30px;"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <a role="button" href="https://m.me/848894218561129" target="_blank" class="btn-floating btn-fbm" title="¡Escríbenos por FB Messenger!">
    <img src="{{url('assets_front/images/messenger.svg')}}" style="height:30px;">
  </a>
  <a role="button" href="javascript:void(0)" class="btn-floating btn-wha btn-success" title="¡Escríbenos por Whatsapp!"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>

  <script src="{{url('assets_front/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{url('assets_front/vendor/animsition/js/animsition.min.js')}}"></script>
  <script src="{{url('assets_front/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{url('assets_front/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{url('assets_front/vendor/select2/select2.min.js')}}"></script>

  <script src="{{url('assets_front/vendor/slick/slick.min.js')}}"></script>
  <script src="{{url('assets_front/js/slick-custom.js')}}"></script>
  {{-- <script src="{{url('assets_front/vendor/sweetalert/sweetalert.min.js')}}"></script> --}}
  <script src="{{url('assets_front/js/main.js')}}"></script>
  <script src="{{url('assets_front/js/owl.carousel.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script type="text/javascript">
  
      $(".has-menu").click(function(){
        $(this).find(".sub_menu").toggleClass("show");
        $(this).toggleClass("open");
      });

        $(document).ready(function(){

            @if($errors->any())
				@foreach ($errors->all() as $error)

					Swal.fire("ERROR","{{$error}}","error");

				@endforeach
			@endif
			@if(session('status'))

				Swal.fire("EXITO","{{ session('status') }}","success");

			@endif

        });

  </script>
  @yield('especifico')
</body>
</html>
