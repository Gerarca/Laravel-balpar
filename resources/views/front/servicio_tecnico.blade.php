@extends('layouts.front')
@section('title','Servicios |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets_front/images/nosotros.jpg);">
    <h2 class="l-text2 t-center">
      Servicio Técnico
    </h2>
  </section>

  <section class="bgwhite p-t-50 p-b-50">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-b-30 box-info box-info1">
          <div class="m-b-25">
            <h5 class="font-weight-bold">
              Contacto Servicio 1
            </h5>
            <ul>
              <li class="p-b-9 m-t-10">
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
          </div>
          <div class="m-b-25">
            <h5 class="font-weight-bold">
              Contacto Servicio 2
            </h5>
            <ul>
              <li class="p-b-9 m-t-10">
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
          </div>
          <div class="m-b-25">
            <h5 class="font-weight-bold">
              Contacto Servicio 3
            </h5>
            <ul>
              <li class="p-b-9 m-t-10">
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
