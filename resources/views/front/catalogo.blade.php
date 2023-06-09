@extends('layouts.front')

@isset($metaTags)

    @section('keywords',$metaTags['keywords'])

    @section('title',$metaTags['titulo'] . ' |')
    @section('og:description', $metaTags['descripcion'] )
    @section('og:url', $metaTags['url'])
    @section('og:type', 'product.item')
    @if($metaTags['imagen'])
        @section('og:image', asset('uploads/'.$metaTags['imagen']))
        @section('og:image:type', mime_content_type(public_path('uploads/'.$metaTags['imagen'])))
        @section('og:image:width', getimagesize(public_path('uploads/'.$metaTags['imagen']))[0])
        @section('og:image:height', getimagesize(public_path('uploads/'.$metaTags['imagen']))[1])
    @endif

@endisset

@section('content')
  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ url('assets_front/images/balpar_bannner.jpeg') }});">
    <h2 class="l-text2 t-center">
      Catálogo
    </h2>
  </section>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('front.index')}}">Inicio</a></li>
        <li class="breadcrumb-item" aria-current="page">Catálogo</li>
        <li class="breadcrumb-item {{ isset($rubro) ? '' : 'active' }}" aria-current="page">{{ $categoria->categoria }}</li>
        @isset($rubro)
            <li class="breadcrumb-item active" aria-current="page">{{ $rubro->rubro }}</li>
        @endisset
      </ol>
    </nav>
  </div>

  <section class="bgwhite p-b-50">
    <div class="container-fluid">
      <div class="row">

        <div class="sidebar col-sm-6 col-md-4 col-lg-3 p-b-50">
          <div class="leftbar p-r-20 p-r-0-sm">
            <button type="button" class="btn_close_filter text-right w-100"><i class="fa fa-times" aria-hidden="true"></i></button>
            <div class="search-product pos-relative bo4 of-hidden mb-4">
                <form action="{{ route('front.buscar.catalogo') }}" method="post">
                    @csrf
                    <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search_product" placeholder="Buscar">
                    <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                      <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <h4 class="m-text11 p-b-7 font-weight-bold">
              Marca
            </h4>
            <ul>
                @foreach($marcas as $marca_item)
                    <li class="p-t-4">
                        <a href="{{ route('front.catalogo.marca', ['marca' => $marca_item->id, 'nombre' => Str::slug($marca_item->nombre)]) }}" class="s-text13"
                            @if(isset($marca))
                                style="{{ $marca_item->id == $marca->id ? 'color: #12488f; font-weight: 500;' : '' }}"
                            @endif
                            >
                            {{ $marca_item->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <hr>
            <h4 class="m-text11 p-b-7 font-weight-bold ">
              Uso
            </h4>
            <ul>
                @foreach($categoria->usos as $uso_item)
                    <li class="p-t-4">
                        <a href="{{ route('front.catalogo.uso', ['uso' => $uso_item->id, 'nombre' => Str::slug($uso_item->uso)]) }}" class="s-text13"
                            @if(isset($uso))
                                style="{{ $uso_item->id == $uso->id ? 'color: #12488f; font-weight: 500;' : '' }}"
                            @endif
                            >
                            {{ $uso_item->uso }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <hr>
            <h4 class="m-text11 p-b-7 font-weight-bold ">
              Rubro
            </h4>
            <ul>
                @foreach($categoria->rubros as $rubro_item)
                    <li class="p-t-4">
                        <a href="{{ route('front.catalogo.rubro', ['rubro' => $rubro_item->id, 'nombre' => Str::slug($rubro_item->rubro)]) }}" class="s-text13"
                            @if(isset($rubro))
                                style="{{ $rubro_item->id == $rubro->id ? 'color: #12488f; font-weight: 500;' : '' }}"
                            @endif
                            >
                            {{ $rubro_item->rubro }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <hr>
            <h4 class="m-text11 p-b-7 font-weight-bold ">
              Etiquetas
            </h4>
            <ul class="tagcloud">
                @foreach($etiquetas as $etiqueta)
                    <li class="tag">
                        <a href="{{ route('front.catalogo.etiqueta', ['etiqueta' => $etiqueta, 'nombre' => Str::slug($etiqueta->nombre)]) }}" class="">
                            {{ $etiqueta->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 p-b-50">
          <div class="row" style="row-gap: 12px;">
            @isset($rubro)
              <div class="col-12 col-md-4 d-flex justify-content-center  order-md-last">
                <h3>{{ $rubro->rubro }}</h3>
              </div>
            @endisset
            <div class="col-12 col-md-4">
              <button role="button" class="btn btn-outline-primary btn_filter mb-4"><i class="fa-th-large fas mr-2"></i>Categorías</button>
            </div>
          </div>
          <div class="row">
            @foreach($productos as $producto)
                @if($producto->visible <> 0)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 p-b-50">
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <a href="{{route('front.producto', ['producto' => $producto->id, 'nombre' => Str::slug($producto->nombre)])}}">
                                    <img src="{{url('storage/productos/thumbs/'. $producto->imagen)}}" loading="lazy">
                                </a>
                            </div>
                            <div class="block2-txt p-t-20">
                                <a href="{{route('front.producto', ['producto' => $producto->id, 'nombre' => Str::slug($producto->nombre)])}}" class="block2-name dis-block product-name">
                                    {{ $producto->nombre }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
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
