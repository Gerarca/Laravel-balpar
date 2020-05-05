@extends('layouts.front')
@section('title','Nombre Producto |')
@section('content')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('front.index')}}">Inicio</a></li>
        {{-- <li class="breadcrumb-item"><a href="{{route('front.catalogo')}}">Catálogo</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">Nombre Producto</li>
      </ol>
    </nav>
  </div>

  <div class="container bgwhite p-t-35 p-b-80">
    <div class="flex-w flex-sb">
      <div class="w-size13 p-t-30 respon5">
        <div class="wrap-slick3 flex-sb flex-w">
          <div class="wrap-slick3-dots"></div>
          <div class="slick3">
            <div class="item-slick3" data-thumb="{{url('storage/productos/'. $producto->imagen)}}">
              <div class="wrap-pic-w">
                <img src="{{url('storage/productos/'. $producto->imagen)}}">
              </div>
            </div>
            @if($producto->imagen2 <> '')
                <div class="item-slick3" data-thumb="{{url('storage/productos/'. $producto->imagen2)}}">
                  <div class="wrap-pic-w">
                    <img src="{{url('storage/productos/'. $producto->imagen2)}}">
                  </div>
                </div>
            @endif

            @if($producto->imagen3 <> '')
                <div class="item-slick3" data-thumb="{{url('storage/productos/'. $producto->imagen3)}}">
                  <div class="wrap-pic-w">
                    <img src="{{url('storage/productos/'. $producto->imagen3)}}">
                  </div>
                </div>
            @endif

            @if($producto->imagen4 <> '')
                <div class="item-slick3" data-thumb="{{url('storage/productos/'. $producto->imagen4)}}">
                  <div class="wrap-pic-w">
                    <img src="{{url('storage/productos/'. $producto->imagen4)}}">
                  </div>
                </div>
            @endif

          </div>
        </div>
      </div>

      <div class="w-size14 p-t-30 respon5">
        <h4 class="product-detail-name m-text16 p-b-13 font-weight-bold">
          {{ $producto->nombre }}
        </h4>

        <p class="s-text8 p-t-10">
          {{ $producto->subtitulo }}
        </p>

        <div class="p-t-10 p-b-40">
          <div class="flex-r-m flex-w p-t-10">
            <div class="w-100 flex-m flex-w">

              <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                  <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                </button>
                <input id="cantidad_input" class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">
                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                  <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                </button>
              </div>

              <div class="btn-wrapper">
                <button class="btn btn-primary flex-c-m sizefull s-text1 trans-0-4 w-100 add-cart" data-prod="{{ $producto->cod_articulo }}">
                  Solicitar Presupuesto
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="p-b-40">
          <span class="s-text8 m-r-35"><strong>Codigo:</strong> {{ $producto->cod_articulo }}</span>
          <span class="s-text8 tags"><strong>Etiquetas:</strong>
                @foreach($producto->etiquetas as $etiqueta)
                  <a href="{{ route('front.catalogo.etiqueta', ['etiqueta' => $etiqueta, 'nombre' => Str::slug($etiqueta->nombre)]) }}">
                      {{ $etiqueta->nombre }}
                  </a>{{ $loop->last ? '' : ',' }}
                @endforeach
          </span>
        </div>

        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
          <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
            Descripción
            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
          </h5>

          <div class="dropdown-content dis-none p-t-15 p-b-23">
              <div class="s-text8">
                {!! $producto->descripcion !!}
              </div>
          </div>
        </div>

        <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
          <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
            Información Adicional
            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
          </h5>

          <div class="dropdown-content dis-none p-t-15 p-b-23">
            <div class="s-text8">
              {!! $producto->informacion !!}
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('especifico')
@endsection
