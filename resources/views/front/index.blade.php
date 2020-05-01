@extends('layouts.front')
@section('content')

  <section class="banner-section">
    <div class="slider-carousel owl-carousel">
        @foreach($banners as $banner)
            <div class="item">
                <img src="{{ url('uploads/'. $banner->imagen) }}">
            </div>
        @endforeach
    </div>
  </section>

  <section class="p-t-80 p-b-80">
    <div class="container-sm text-center" style="max-width:830px;">
      <h2 class="m-text17 text-color m-b-10">Innovación para un país en expansión</h2>
      <p class="text-secondary mb-3">En BALPAR asumimos el compromiso de contribuir con el crecimiento económico del país proveyendo a las pequeñas, medianas y grandes empresas productos y servicios de altísima calidad que garantizan el éxito de sus negocios; lo que se traduce en fuentes de trabajo e ingresos para los colaboradores de tales empresas beneficiando de esa manera al país. </p>
      <a href="{{route('front.nosotros')}}" class="btn btn-primary s-text1 trans-0-4 w-auto">
        Más sobre Nosotros
      </a>
    </div>
  </section>

  {{-- Destacados Comercial --}}
  <section class="newproduct p-b-80 p-t-80 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-lg-1 order-lg-9 flex-m flex-column justify-content-center px-4">
          <h3 class="m-text5 t-center text-color mb-4">
            Destacados Comercial
          </h3>
          <p class="text-secondary mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <a href="{{route('front.catalogo')}}" class="btn btn-primary s-text1 trans-0-4 w-auto mb-5">
            Ver más productos
          </a>
        </div>
        <div class="col-lg-6">
          <div class="wrap-slick wrap-comercial">
            <div class="slick-comercial">
              <div class="item-slick2 p-l-15 p-r-15">
                <div class="block2">
                  <div class="block2-img wrap-pic-w of-hidden pos-relative">
                    <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod1.jpg')}}"></a>
                  </div>
                  <div class="block2-txt p-t-20">
                    <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                      Nombre Producto
                    </a>
                  </div>
                </div>
              </div>
              <div class="item-slick2 p-l-15 p-r-15">
                <div class="block2">
                  <div class="block2-img wrap-pic-w of-hidden pos-relative">
                    <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod2.jpg')}}"></a>
                  </div>
                  <div class="block2-txt p-t-20">
                    <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                      Nombre Producto
                    </a>
                  </div>
                </div>
              </div>
              <div class="item-slick2 p-l-15 p-r-15">
                <div class="block2">
                  <div class="block2-img wrap-pic-w of-hidden pos-relative">
                    <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod3.jpg')}}"></a>
                  </div>
                  <div class="block2-txt p-t-20">
                    <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                      Nombre Producto
                    </a>
                  </div>
                </div>
              </div>
              <div class="item-slick2 p-l-15 p-r-15">
                <div class="block2">
                  <div class="block2-img wrap-pic-w of-hidden pos-relative">
                    <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod4.jpg')}}"></a>
                  </div>
                  <div class="block2-txt p-t-20">
                    <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                      Nombre Producto
                    </a>
                  </div>
                </div>
              </div>
              <div class="item-slick2 p-l-15 p-r-15">
                <div class="block2">
                  <div class="block2-img wrap-pic-w of-hidden pos-relative">
                    <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod5.jpg')}}"></a>
                  </div>
                  <div class="block2-txt p-t-20">
                    <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                      Nombre Producto
                    </a>
                  </div>
                </div>
              </div>
              <div class="item-slick2 p-l-15 p-r-15">
                <div class="block2">
                  <div class="block2-img wrap-pic-w of-hidden pos-relative">
                    <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod3.jpg')}}"></a>
                  </div>
                  <div class="block2-txt p-t-20">
                    <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                      Nombre Producto
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="parallax0 parallax100" id="contador-section" style="background-image: url({{url('assets_front/images/banner2.jpg')}});">
      <div class="overlay0 p-t-80 p-b-45 d-flex justify-content-center" style="background: linear-gradient(140deg, rgba(10, 35, 70, 0.8) 0%, rgba(30, 113, 223, 0.8) 100%);min-height:400px;">
        <div class="flex-col-c-m flex-row row p-l-15 p-r-15 w-100">
          <div class="col-md-4 flex-col-c-m mb-4">
            <span class="m-text9">
              +<span class="counter "data-from="0" data-to="{{ $dato_dinamico->years }}" data-speed="5000" data-refresh-interval="50"></span>
            </span>
            <span class="s-text4 p-t-15 counter-label">
              Años de Trayectoria
            </span>
          </div>
          <div class="col-md-4 flex-col-c-m mb-4">
            <span class="m-text9">
              +<span class="counter "data-from="0" data-to="{{ $dato_dinamico->clientes }}" data-speed="5000" data-refresh-interval="50"></span>
            </span>
            <span class="s-text4 p-t-15 counter-label">
              Clientes Satisfechos
            </span>
          </div>
          <div class="col-md-4 flex-col-c-m mb-4">
            <span class="m-text9">
              +<span class="counter "data-from="0" data-to="{{ $dato_dinamico->trabajos }}" data-speed="5000" data-refresh-interval="50"></span>
            </span>
            <span class="s-text4 p-t-15 counter-label">
              Fuentes de Trabajo
            </span>
          </div>
        </div>
      </div>
    </section>

    {{-- Destacados Industrial --}}
    <section class="newproduct p-b-80 p-t-80 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 flex-m flex-column justify-content-center px-4">
            <h3 class="m-text5 t-center text-color mb-4">
              Destacados Industrial
            </h3>
            <p class="text-secondary mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <a href="{{route('front.catalogo')}}" class="btn btn-primary s-text1 trans-0-4 w-auto mb-5">
              Ver más productos
            </a>
          </div>
          <div class="col-lg-6 offset-lg-1">
            <div class="wrap-slick wrap-industrial">
              <div class="slick-industrial">
                <div class="item-slick2 p-l-15 p-r-15">
                  <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                      <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod5.jpg')}}"></a>
                    </div>
                    <div class="block2-txt p-t-20">
                      <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                        Nombre Producto
                      </a>
                    </div>
                  </div>
                </div>
                <div class="item-slick2 p-l-15 p-r-15">
                  <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                      <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod4.jpg')}}"></a>
                    </div>
                    <div class="block2-txt p-t-20">
                      <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                        Nombre Producto
                      </a>
                    </div>
                  </div>
                </div>
                <div class="item-slick2 p-l-15 p-r-15">
                  <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                      <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod3.jpg')}}"></a>
                    </div>
                    <div class="block2-txt p-t-20">
                      <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                        Nombre Producto
                      </a>
                    </div>
                  </div>
                </div>
                <div class="item-slick2 p-l-15 p-r-15">
                  <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                      <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod2.jpg')}}"></a>
                    </div>
                    <div class="block2-txt p-t-20">
                      <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                        Nombre Producto
                      </a>
                    </div>
                  </div>
                </div>
                <div class="item-slick2 p-l-15 p-r-15">
                  <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                      <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod1.jpg')}}"></a>
                    </div>
                    <div class="block2-txt p-t-20">
                      <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                        Nombre Producto
                      </a>
                    </div>
                  </div>
                </div>
                <div class="item-slick2 p-l-15 p-r-15">
                  <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                      <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod3.jpg')}}"></a>
                    </div>
                    <div class="block2-txt p-t-20">
                      <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                        Nombre Producto
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    {{-- Testimonios --}}
    <section class="newproduct p-b-80 p-t-80">
        <div class="container">
            <div class="sec-title">
                <h3 class="m-text5 t-center text-color mb-4">
                    Testimonios
                </h3>
            </div>
            <div class="marcas-carousel owl-carousel">
                @foreach($testimonios as $testimonio)
                    <div class="item-marca">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $testimonio->nombre }}</h5>
                                <p class="card-text">{{ $testimonio->testimonio }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Marcas --}}
    <section class="newproduct p-b-80 p-t-80">
      <div class="container">
        <div class="sec-title">
          <h3 class="m-text5 t-center text-color mb-4">
            Marcas
          </h3>
        </div>
        <div class="marcas-carousel owl-carousel">
            @foreach($marcas as $marca)
                <div class="item-marca">
                    <a href="{{route('front.catalogo')}}"><img src="{{url('uploads/'. $marca->imagen)}}" alt="{{ $marca->nombre }}" title="{{ $marca->nombre }}"></a>
                </div>
            @endforeach
        </div>

      </div>
    </section>

  @endsection
  @section('especifico')
    <script type="text/javascript">
    $('.slick-comercial').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      autoplay: true,
      arrows: true,
      appendArrows: $('.wrap-comercial'),
      prevArrow:'<button class="arrow-slick2 prev-slick2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
      nextArrow:'<button class="arrow-slick2 next-slick2"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>'
    });

    $('.slick-industrial').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      autoplay: true,
      arrows: true,
      appendArrows: $('.wrap-industrial'),
      prevArrow:'<button class="arrow-slick2 prev-slick2"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
      nextArrow:'<button class="arrow-slick2 next-slick2"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>'
    });
    </script>
    <script type="text/javascript">
    $('.slider-carousel').owlCarousel({
      margin:0,
      loop:true,
      autoplay:true,
      nav:true,
      dots:false,
      navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      items:1
    })

    $('.marcas-carousel').owlCarousel({
      margin:30,
      loop:true,
      autoplay:true,
      autoplayTimeout:3000,
      nav:true,
      navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      dots:false,
      responsiveClass:true,
      responsive:{
        0:{
          items:2,
        },
        600:{
          items:3,
        },
        1000:{
          items:5,
        }
      }
    })
    </script>
    <script src="{{url('assets_front/js/21.jquery.countto.js')}}"></script>
    <script type="text/javascript">
    $('.counter').countTo();
    </script>
  @endsection
