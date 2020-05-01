@extends('layouts.front')
@section('title','Catálogo |')
@section('content')
  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets_front/images/nosotros.jpg);">
    <h2 class="l-text2 t-center">
      Catálogo
    </h2>
  </section>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('front.index')}}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
      </ol>
    </nav>
  </div>

  <section class="bgwhite p-t-50 p-b-50">
    <div class="container">
      <div class="row">

        <div class="sidebar col-sm-6 col-md-4 col-lg-3 p-b-50">
          <div class="leftbar p-r-20 p-r-0-sm">
            <button type="button" class="btn_close_filter text-right w-100 d-lg-none"><i class="fa fa-times" aria-hidden="true"></i></button>
            <div class="search-product pos-relative bo4 of-hidden mb-4">
              <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Buscar">
              <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                <i class="fs-12 fa fa-search" aria-hidden="true"></i>
              </button>
            </div>
            <h4 class="m-text11 p-b-7 font-weight-bold">
              Marca
            </h4>
            <ul>
                @foreach($marcas as $marca)
                    <li class="p-t-4"><a href="#" class="s-text13">{{ $marca->nombre }}</a></li>
                @endforeach
            </ul>

            <hr>
            <h4 class="m-text11 p-b-7 font-weight-bold ">
              Uso
            </h4>
            <ul>
                @foreach($usos as $uso)
                    <li class="p-t-4">
                        <a href="#" class="s-text13">
                            {{ $uso->uso }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <hr>
            <h4 class="m-text11 p-b-7 font-weight-bold ">
              Rubro
            </h4>
            <ul>
                @foreach($rubros as $rubro)
                    <li class="p-t-4">
                        <a href="#" class="s-text13">
                            {{ $rubro->rubro }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <hr>
            <h4 class="m-text11 p-b-7 font-weight-bold ">
              Etiquetas
            </h4>
            <ul class="tagcloud">
              <li class="tag">
                <a href="#" class="">
                  Etiqueta 1
                </a>
              </li>

              <li class="tag">
                <a href="#" class="active">
                  Etiqueta 2
                </a>
              </li>

              <li class="tag">
                <a href="#" class="">
                  Etiqueta 3
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-12 col-lg-9 p-b-50">
          <button role="button" class="btn btn-outline-primary btn_filter d-lg-none">Categorías</button>
          <div class="row">
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
              <div class="block2">
                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                  <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod6.jpg')}}"></a>
                </div>
                <div class="block2-txt p-t-20">
                  <a href="{{route('front.producto')}}" class="block2-name dis-block product-name">
                    Nombre Producto
                  </a>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
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
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 p-b-50">
              <div class="block2">
                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                  <a href="{{route('front.producto')}}"><img src="{{url('assets_front/images/prod6.jpg')}}"></a>
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

@endsection
@section('especifico')
  <script type="text/javascript">
  $(".btn_filter").click(function (e) {
    e.preventDefault();
    $(".sidebar").toggleClass("show");
  });
  $(".btn_close_filter,#filtrador_btn").click(function (e) {
    e.preventDefault();
    $(".sidebar").removeClass("show");
  });
  </script>
@endsection
