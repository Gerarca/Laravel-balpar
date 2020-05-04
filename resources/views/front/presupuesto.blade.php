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

            <tr class="table-row">
              <td class="column-1">
                <div class="cart-img-product b-rad-4 o-f-hidden">
                  <img src="{{url('assets_front/images/prod1.jpg')}}">
                </div>
              </td>
              <td class="column-2"><a href="{{route('front.producto', ['producto' => 1, 'nombre' => 'prueba'])}}">Nombre Producto</a></td>
              <td class="column-4" data-title="Cantidad: ">
                <div class="flex-w bo5 of-hidden w-size17">
                  <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                  </button>

                  <input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="1">

                  <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
              </td>
              <td class="column-5"><button type="button" name="button" title="Quitar Producto"><i class="fas fa-trash"></i></button></td>
            </tr>

            <tr class="table-row">
              <td class="column-1">
                <div class="cart-img-product b-rad-4 o-f-hidden">
                  <img src="{{url('assets_front/images/prod1.jpg')}}">
                </div>
              </td>
              <td class="column-2"><a href="{{route('front.producto', ['producto' => 1, 'nombre' => 'prueba'])}}">Nombre Producto</a></td>
              <td class="column-4" data-title="Cantidad: ">
                <div class="flex-w bo5 of-hidden w-size17">
                  <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                  </button>

                  <input class="size8 m-text18 t-center num-product" type="number" name="num-product2" value="1">

                  <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
              </td>
              <td class="column-5"><button type="button" name="button" title="Quitar Producto"><i class="fas fa-trash"></i></button></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="bo9 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
      <div class="col-md-6 mx-auto">
          <h5 class="m-text20 p-b-24">
          Datos del cliente
        </h5>
        <p class="mb-4">Completa tus datos para que nuestro equipo comercial se ponga en contacto y te facilite el presupuesto que estás necesitando</p>
        <form action="#" method="post">
          <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nombre y Apellido">
          </div>

          <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Teléfono">
          </div>

          <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email">
          </div>
          <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Empresa (opcional)">
          </div>
          <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Mensaje"></textarea>
          <div class="size15 trans-0-4">
            <button class="btn btn-primary float-right flex-c-m bg0 hov1 s-text1 trans-0-4">
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
@endsection
