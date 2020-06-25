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
  <link rel="stylesheet" type="text/css" href="{{url('assets_front/css/estilos.css?v=1.7')}}">

</head>
<body class="animsition">

  <header class="header1">
    <div class="container-menu-header">
      <div class="topbar">
        <div class="topbar-social">
          <a href="https://www.facebook.com/Balanzas-Paraguayas-SA-Balpar-848894218561129/" target="_blank" class="topbar-social-item fab fa-facebook-f"></a>
          <a href="https://www.instagram.com/balparpy/" target="_blank" class="topbar-social-item fab fa-instagram"></a>
          <a href="https://www.linkedin.com/company/49076293" target="_blank" class="topbar-social-item fab fa-linkedin"></a>
        </div>
        <div class="topbar-child2">
          <span class="topbar-links d-none d-lg-block">
            <a href="{{route('front.catalogos')}}"><i class="fas fa-file-download"></i> Descargar Catálogo</a>
          </span>
          <span class="topbar-phone">
            <a href="tel:021 511 475"><i class="fas fa-phone"></i> 021 511 475</a>
          </span>
        </div>
      </div>
      <div class="wrap_header container-fluid px-0">
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
                <ul class="sub_menu py-0">
                    @foreach($categories as $category)
                        <li class="has-submenu">
                            <a href="{{route('front.catalogo.categoria', ['categoria' => $category->id, 'nombre' => Str::slug($category->categoria)])}}">{{ $category->categoria }}</a>
                            <ul class="theme_menu submenu">
                                @foreach($category->rubros as $rubro_category)
                                    <li>
                                        <a href="{{ route('front.catalogo.rubro', ['rubro' => $rubro_category->id, 'nombre' => Str::slug($rubro_category->rubro)]) }}">
                                            {{ $rubro_category->rubro }}
                                        </a>
                                    </li>
                                    @if($loop->iteration == 10)
                                        <li>
                                            <a href="{{route('front.catalogo.categoria', ['categoria' => $category->id, 'nombre' => Str::slug($category->categoria)])}}" class="font-weight-bold">
                                                Ver todos
                                            </a>
                                        </li>
                                        @php break; @endphp
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    <li><a href="{{ route('front.catalogo.todos') }}" class="font-weight-bold">Ver todos los productos</a> </li>
                </ul>
              </li>
              <li class="has-menu">
                <a href="javascript:void(0)">Servicios</a>
                <ul class="sub_menu">
                  <li><a href="{{route('front.servicio_tecnico')}}">Servicio Técnico</a></li>
                </ul>
              </li>
              <li>
                <a href="{{route('front.trabajos_realizados')}}">Trabajos Realizados</a>
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
                  <form action="{{ route('front.buscar.catalogo') }}" method="post">
                      @csrf
                      <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search_product" placeholder="Buscar">
                      <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4 btn-search-toggle">
                          <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                      </button>
                  </form>
              </div>
            </div>
          </div>
          <span class="linedivide1"></span>
          {{-- Header cart --}}
          <div class="header-wrapicon header-wrapicon2">
            <i class="fas fa-receipt header-icon1 js-show-header-dropdown"></i>
            <div class="header-cart header-dropdown">
              <ul class="header-cart-wrapitem cart-products-container">

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
          <!-- SnapWidget -->
          <script src="https://snapwidget.com/js/snapwidget.js"></script>
          <iframe src="https://snapwidget.com/embed/837290" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden;  width:100%; "></iframe>
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
  <a role="button" href="https://api.whatsapp.com/send?phone=595991166277&text=Hola!%20Estoy%20escribiendo%20desde%20el%20sitio%20web%20de%20Balpar%20y%20tengo%20una%20consulta." target="_blank" class="btn-floating btn-wha btn-success" title="¡Escríbenos por Whatsapp!"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>

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
      // $(".has-submenu").click(function(){
      //   $(this).find(".theme_menu").toggleClass("show");
      //   $(this).toggleClass("open");
      // });

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

        $(document).ready(function(){
            const getProductos = function () {
            $('.cart-products-container').html('');
            $.ajax({
                url: '{{ route('ajax.getProductos') }}',
                beforeSend: function () {
                    $('.cart-sidebar .product').remove();
                },
                success: function (respuesta) {

                    if (respuesta.length) {

                        Object.values(respuesta).forEach(item => {
                            $('.cart-products-container').append(`

                                <li class="header-cart-item">
                                  <div class="header-cart-item-img">
                                    <img src="${item.imagen}">
                                  </div>
                                  <div class="header-cart-item-txt">
                                    <a href="${item.url}" class="header-cart-item-name">
                                      ${item.nombre}
                                    </a>
                                    <span class="header-cart-item-info">Cantidad: ${item.cantidad}</span>
                                  </div>
                                </li>

                                `);
                            });
                        } else {
                            $('.cart-products-container').append('Sin producto en el carrito');
                        }
                    }
                });
            };

            $(function () {
                getProductos();
            });

            $('.add-cart').each(function() {
                $(this).on('click', function() {
                    var cod_articulo=$(this).data('prod');
                    var cantidad=$('#cantidad_input').val();
                    cantidad=(cantidad>=1)?cantidad:1;
                    $.ajax({
                        url: '{{ route('ajax.addProducto') }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        method: 'POST',
                        data: {
                            cod_articulo:cod_articulo, cantidad:cantidad
                        },
                        beforeSend: function() {
                            Swal.fire({
                                onBeforeOpen: () => {
                                  Swal.showLoading()
                                },
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                text: 'Procesando...',
                            })
                        },
                        success: function (x) {
                            Swal.fire({
                                title: 'Exito',
                                text: "El producto fue agregado exitosamente a tu carrito.",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#28a745',
                                confirmButtonText: 'Ir al carrito',
                                cancelButtonText: 'Ver más productos'
                            }).then((result) => {
                              if (result.value) {
                                window.location = "{{route('front.presupuesto')}}"
                              }
                            })

                        },
                        error: function (x) {
                            if (x.responseJSON && x.responseJSON.hasOwnProperty('respuesta')) {
                                Swal.fire({
                                    title: 'Error',
                                    text: x.responseJSON.error,
                                    icon: 'error',
                                    showCloseButton: true
                                });
                            }
                        },
                        complete: function () {
                            getProductos();
                        }
                    });

                });
            });

            const delProducto = function (cod_articulo, cb = null) {
                $.ajax({
                    url: '{{ route('ajax.delProducto') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        cod_articulo
                    },
                    success: function (r) {
                        if (typeof cb === "function") {
                            cb();
                        }
                    },
                    complete: function() {
                        getProductos();
                    }
                });
            };

            $(document).on('click', '.cart-delete', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).parent().parent().remove();
                const product = $(this).parents('.product');
                const cod_articulo = $(this).data('cod');

                delProducto(cod_articulo);
            });

        });

  </script>
  @yield('especifico')
</body>
</html>
