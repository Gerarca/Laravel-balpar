<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title', '') Balpar S.A.</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Balpar S.A">
  <meta name="description" content="Innovación para un país en expansión. Calidad en pesaje industrial y comercial, equipos para supermercados y cepillería industrial.">
  <meta name="keywords" content="@yield('keywords','')"/>

    <meta property="og:url" content="@yield('og:url', URL::current())"/>
    <meta property="og:type" content="@yield('og:type', 'website')"/>
    <meta property="og:title" content="@yield('title','') Balpar S.A"/>
    <meta property="og:description" content="@yield('og:description', 'Innovación para un país en expansión. Calidad en pesaje industrial y comercial, equipos para supermercados y cepillería industrial.')"/>
    <meta property="og:image" content="@yield('og:image', url('assets_front/images/favicon.png'))"/>
    <meta property="og:image:type" content="@yield('og:image:type', 'image/png')" />
    <meta property="og:image:width" content="@yield('og:image:width', 194)" />
    <meta property="og:image:height" content="@yield('og:image:height', 194)" />

  <link rel="icon" type="image/png" href="{{url('assets_front/images/favicon.png')}}"/>

  <link rel="stylesheet" href="{{ url('assets_front/css/combined.min.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


  <style media="screen">
      .verTodos:hover > .listaOculta{
        display: block;
      }
  </style>

  <!-- Facebook Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window,document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
   fbq('init', '345741273251095');
  fbq('track', 'PageView');
  </script>
  <noscript>
   <img height="1" width="1"
  src="https://www.facebook.com/tr?id=345741273251095&ev=PageView
  &noscript=1"/>
  </noscript>
  <!-- End Facebook Pixel Code -->
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
        <div class="justify-content-between row mx-0 align-items-center h-100 w-100">
          {{-- Header Icons --}}
          <div class="col-md-4 col-2 header-icons justify-content-center">
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


          </div>
          <a href="{{route('front.index')}}" class="col-8 col-md-4 col-auto logo d-flex">
            <img src="{{url('assets_front/images/logo.png')}}" alt="Logo" class="mx-auto" style="max-height: 25px;">
          </a>

          {{-- Header Icons --}}
          <div class="col-md-4 col-2 header-icons justify-content-center">

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

          </div>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="main_menu navbar-nav mx-auto">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorías</a>
              <ul class="dropdown-menu">
                @foreach($categories as $category)
                  <li class="dropdown-item dropdown"><a href="{{route('front.catalogo.categoria', ['categoria' => $category->id, 'nombre' => Str::slug($category->categoria)])}}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $category->categoria }}</a>
                    @if($category->rubros->isNotEmpty())
                      <ul class="dropdown-menu">
                        @foreach($category->rubros->take(8) as $rubro_category)
                          @if($rubro_category->productos->where('visible', 1)->isNotEmpty())
                            <li class="dropdown-item"><a href="{{ route('front.catalogo.rubro', ['rubro' => $rubro_category->id, 'nombre' => Str::slug($rubro_category->rubro)]) }}">{{ $rubro_category->rubro }}</a></li>
                          @endif
                        @endforeach
                        @if($category->rubros->count() > 8)
                          <li class="dropdown-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ver todos</a>
                            <ul class="dropdown-menu">
                              @foreach(range(8, $category->rubros->count() - 1) as $position)
                                <li class="dropdown-item"><a href="{{ route('front.catalogo.rubro', ['rubro' => $category->rubros[$position]->id, 'nombre' => Str::slug($category->rubros[$position]->rubro)]) }}">{{ $category->rubros[$position]->rubro }}</a></li>
                              @endforeach
                            </ul>
                          </li>
                        @endif
                      </ul>
                    @endif
                  </li>

                @endforeach
                <li><a href="{{ route('front.catalogo.todos') }}" class="dropdown-item font-weight-bold">Ver todos los productos</a> </li>
              </ul>
            </li>

              <li class="nav-item ">
                <a href="{{route('front.nosotros')}}" class="nav-link">Nosotros</a>
              </li>
              <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="nav-link">Servicios</a>
                <ul class="sub_menu">
                  <li><a href="{{route('front.servicio_tecnico')}}">Servicio Técnico</a></li>
                </ul>
              </li>
              <li class="nav-item ">
                <a href="{{route('front.trabajos_realizados')}}" class="nav-link">Trabajos Realizados</a>
              </li>
              <li class="nav-item ">
                <a href="{{route('front.blog')}}" class="nav-link">Blog</a>
              </li>
              <li class="nav-item ">
                <a href="{{route('front.contacto')}}" class="nav-link">Contacto</a>
              </li>
              <li class="d-lg-none">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" class="nav-link" download><i class="fas fa-file-download"></i> Descargar Catálogo</a>
              </li>
            </ul>

        </div>
      </nav>
    </div>
  </header>

  @yield('content')

  <footer class="p-t-45 p-b-20 p-l-45 p-r-45">
    <div class="container">
      <div class="row flex-w">
        <div class="col-md-4 py-2 flex-column">
          <a href="{{route('front.index')}}"><img src="{{url('assets_front/images/logo.png')}}" class="white-img" style="height:30px;"></a>
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
          <script src="https://apps.elfsight.com/p/platform.js" defer></script>
          <div class="elfsight-app-350497ba-60ed-4856-a173-1e6d9a195696"></div>
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

  <script src="{{ url('assets_front/js/combined.min.js') }}"></script>
    <script src="{{ url('assets_front/js/bootstrap-navbar-dropdowns.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script type="text/javascript">
  if ($(window).width() < 991) {
    $('.navbar').navbarDropdown({
      // bs3 | bs4 | bs5
      theme: 'bs4',
      // click | mouseover
      trigger: 'click',
      // override the default selector of the dropdown
      dropdownSelector: null
    });
  }
  else {
     $('.navbar').navbarDropdown({
       theme: 'bs4',
       trigger: 'mouseover',
       dropdownSelector: null
     });
  }

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
