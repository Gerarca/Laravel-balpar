@extends('layouts.front')
@section('title','Servicio Técnico |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets_front/images/nosotros.jpg);">
    <h2 class="l-text2 t-center">
      Servicio Técnico
    </h2>
  </section>

  <section class="p-t-40 p-b-30 bg-light">
  <div class="container-sm text-center" style="max-width:830px;">
    <p class="mb-3"><strong class="text-color">BALPAR S.A</strong>, empresa Paraguaya con más de 28 años de experiencia en el mercado, brindando asistencia integral especializada por profesionales altamente calificados, con la finalidad de realizar Mantenimiento Preventivo de Piezas, Calibración de Equipos de Pesaje; Balanzas, Básculas y la Reparación de Equipos dañados en todas las marcas que representamos, reafirmando así nuestro compromiso con cada cliente.</p>
    <p class="text-color font-weight-bold mb-3">Nuestro objetivo principal es poder construir vínculos reales con nuestros clientes, logrando lazos con cada uno a lo largo del tiempo. </p>
  </div>
</section>

  <section class="bgwhite p-t-50 p-b-50">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-b-30 box-info box-info1 justify-content-start">
          <div class="container tw-box w-100 m-b-40">
            <h4 class="p-b-36">
              Servicio de Asistencia Técnica
            </h4>
          </div>
          <div class="container tw-box w-100 m-b-40">
            <div class="row">
              <div class="col-1 tw-box-icon">
                <i class="fas fa-phone"></i>
              </div>
              <div class="col-11">
                <h5 class="font-weight-bold">Teléfono</h5>
                <p class="description">
                  <a href="tel:+595 992 267 406">+595 992 267 406</a>
                </p>
              </div>
            </div>
          </div>
          <div class="container tw-box w-100 m-b-40">
            <div class="row">
              <div class="col-1 tw-box-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="col-11">
                <h5 class="font-weight-bold">Email</h5>
                <p class="description">
                  <a href="mailto:sat@balpar.com.py">sat@balpar.com.py</a>
                </p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-6 p-b-30 box-info">
          <form class="leave-comment">
            <h4 class="p-b-36">
              Solicitud de Servicio Técnico
            </h4>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nombre">
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Dirección">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Teléfono">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email">
            </div>

            <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Mensaje"></textarea>

            <div class="w-size25">
              <button class="btn btn-primary flex-c-m size2">
                Enviar Solicitud
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <h3 class="m-text5 t-center line-divider">
        <span>Preguntas Frecuentes</span>
      </h3>
      <div class="wrap-dropdown-content bo6 border-top-0 p-t-15 p-b-14 active-dropdown-content">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
          Pregunta 1
          <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
          <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
          <p class="s-text8">
            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
          </p>
        </div>
      </div>
      <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
          Pregunta 2
          <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
          <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
          <p class="s-text8">
            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
          </p>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('especifico')
@endsection
