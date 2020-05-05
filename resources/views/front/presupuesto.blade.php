@extends('layouts.front')
@section('title','Presupuesto |')
@section('content')
  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets_front/images/nosotros.jpg);">
    <h2 class="l-text2 t-center">
      Solicitar Presupuesto
    </h2>
  </section>

  <section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">

      <div class="container-table-cart pos-relative">
        <div class="wrap-table-shopping-cart bgwhite">
          <table class="table-shopping-cart">
            <tr class="table-head">
              <th class="column-1"></th>
              <th class="column-2">Producto</th>
              <th class="column-4">Cantidad</th>
              <th class="column-5">Acciones</th>
            </tr>

            @foreach($carrito_detalles as $key => $detalle)
                <tr class="table-row">
                    <td class="column-1">
                        <div class="cart-img-product b-rad-4 o-f-hidden">
                            <img src="{{ $detalle['imagen'] }}">
                        </div>
                    </td>
                    <td class="column-2">
                        <a href="{{route('front.producto', ['producto' => $detalle['id'], 'nombre' => Str::slug($detalle['nombre'])])}}">
                            {{ $detalle['nombre'] }}
                        </a>
                    </td>
                    <td class="column-4" data-title="Cantidad: ">
                        {{-- <div class="flex-w bo5 of-hidden w-size17">
                            <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                            </button>

                            <input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="{{ $detalle['cantidad'] }}">

                            <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div> --}}
                        {{ $detalle['cantidad'] }}
                    </td>
                    <td class="column-5"><button type="button" name="button" class="cart-delete" title="Quitar Producto" data-cod="{{ $detalle['cod_articulo'] }}"><i class="fas fa-trash"></i></button></td>
                </tr>
            @endforeach

          </table>
        </div>
      </div>

      <div class="bo9 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
      <div class="col-md-6 mx-auto">
          <h5 class="m-text20 p-b-24">
          Datos del cliente
        </h5>
        <p class="mb-4">Completa tus datos para que nuestro equipo comercial se ponga en contacto y te facilite el presupuesto que estás necesitando</p>
        <form action="{{ route('front.carritoFinalizar') }}" method="post" id="FormSolicitud">
            @csrf
            <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="nombre" value="{{ old('nombre') }}" required placeholder="Nombre y Apellido">
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="telefono" value="{{ old('telefono') }}" required placeholder="Teléfono">
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="empresa" value="{{ old('empresa') }}" placeholder="Empresa (opcional)">
            </div>
            <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="mensaje" value="{{ old('mensaje') }}" placeholder="Mensaje"></textarea>
            <div class="size15 trans-0-4">
                <button type="submit" class="btn btn-primary float-right flex-c-m bg0 hov1 s-text1 trans-0-4">
                    Pedir Presupuesto
                </button>
            </div>
        </form>
      </div>
      </div>
    </div>
  </section>
@endsection

@section('especifico')

    <script>

    $("#FormSolicitud").submit(function(){
        Swal.fire({
            onBeforeOpen: () => {
              Swal.showLoading()
            },
            allowEscapeKey: false,
            allowOutsideClick: false,
            text: 'Procesando solicitud, espere por favor',
        })
    });

    </script>

@endsection
