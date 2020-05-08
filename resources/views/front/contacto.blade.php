@extends('layouts.front')
@section('title','Contacto |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets_front/images/nosotros.jpg);">
    <h2 class="l-text2 t-center">
      Contacto
    </h2>
  </section>

  <section class="p-t-50 p-b-50">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-b-30 box-info box-info1">
          <div class="container tw-box w-100 m-b-40">
            <div class="row">
              <div class="col-1 tw-box-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="col-11">
                <h5 class="font-weight-bold mb-2">Dirección</h5>
                <p class="description">
                  <a href="https://goo.gl/maps/UFVu7vSabQt3WCTW8" target="_blank">Av. Madame Lynch esq. Soriano Gonzalez - Asunción, Paraguay</a>
                </p>
              </div>
            </div>
          </div>
          <div class="container tw-box w-100 m-b-40">
            <div class="row">
              <div class="col-1 tw-box-icon">
                <i class="fas fa-phone"></i>
              </div>
              <div class="col-11">
                <h5 class="font-weight-bold mb-2">Teléfono</h5>
                <p class="description">
                  <div class="mb-2">
                    <p class="info-text">Ventas</p>
                    <a href="tel:+595 991 166277">+595 991 166 277</a> <br>
                  </div>
                  <div class="">
                    <p class="info-text">Servicio de Asistencia Técnica</p>
                    <a href="tel:+595 992 267 406">+595 992 267 406</a>
                  </div>
                  <div class="mb-2">
                    <p class="info-text">Línea baja</p>
                    <a href="tel:021 511 475">021-511-475</a><br>
                    <a href="tel:021 520 062">021-520-062</a>
                  </div>
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
                <h5 class="font-weight-bold mb-2">Email</h5>
                <p class="description">
                  <div class="mb-2">
                    <p class="info-text">Ventas</p>
                    <a href="mailto:ventas@balpar.com.py">ventas@balpar.com.py</a>
                  </div>
                  <div class="">
                    <p class="info-text">Servicio técnico</p>
                    <a href="mailto:sac@balpar.com.py">sac@balpar.com.py</a>
                  </div>
                </p>
              </div>
            </div>
          </div>
          <div class="social-icons flex-m pb-5">
            <a href="https://www.facebook.com/Balanzas-Paraguayas-SA-Balpar-848894218561129/" target="_blank" class="fs-18 p-r-20 fab fa-facebook-f"></a>
            <a href="https://www.instagram.com/balparpy/" target="_blank" class="fs-18 p-r-20 fab fa-instagram"></a>
          </div>
        </div>
        <div class="col-md-6 p-b-30">
          <form class="leave-comment" action="{{ route('front.contacto.send') }}" method="POST" enctype="multipart/form-data" id="FormContacto">
              @csrf
            <h4 class="p-b-36 p-t-15">
              Contactanos
            </h4>
            <div class="bo4 of-hidden size15 m-b-20">
              <select class="sizefull s-text7 border-0 p-l-22 p-r-22" name="asunto" id="asunto" required>
                <option value="" selected disabled>Asunto</option>
                <option value="1">Contacto</option>
                <option value="2">Trabajá con nosotros</option>
                <option value="3">Quejas y Sugerencias</option>
              </select>
            </div>
            <div class="of-hidden size15 m-b-20" id="cv-input">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="file" name="archivo" accept="application/msword,application/pdf,.docx">
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="nombre" required value="{{ old('nombre') }}" placeholder="Nombre">
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="telefono" required value="{{ old('telefono') }}" placeholder="Teléfono">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" required value="{{ old('email') }}" placeholder="Email">
            </div>

            <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="mensaje" required placeholder="Mensaje">{{ old('mensaje') }}</textarea>

            <div class="w-size25">
              <div class="g-recaptcha" data-sitekey="6LcjBfMUAAAAALX80qvyB0pUoE0LtECnyKbsUV9O"></div>
              <button class="btn btn-primary flex-c-m size2 m-text3 trans-0-4">
                Enviar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

    {{-- Testimonios --}}
    {{-- <section class="newproduct p-b-80 p-t-80">
        <div class="container">
            <div class="sec-title">
                <h3 class="m-text5 t-center text-color mb-4">
                    Testimonios
                </h3>
            </div>
            <div class="testimonios-carousel owl-carousel">
                @foreach($testimonios as $testimonio)
                    <div class="item-testimonio">
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
    </section> --}}

  <section>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14427.314806682854!2d-57.5541044!3d-25.3099587!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa2e47a29fc2f49e3!2sBalpar%20S.A.!5e0!3m2!1ses-419!2spy!4v1583264226416!5m2!1ses-419!2spy" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </section>

@endsection

@section('especifico')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script>
  $("#cv-input").hide();
  $("#asunto").on('change', function() {
      let asunto = $("#asunto option:selected").val();
      if (asunto == 2) {
          $("#cv-input").show();
      } else {
          $("#cv-input").hide();
      }
  });

  $('.testimonios-carousel').owlCarousel({
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

  $("#FormContacto").submit(function(){
      Swal.fire({
          onBeforeOpen: () => {
            Swal.showLoading()
          },
          allowEscapeKey: false,
          allowOutsideClick: false,
          text: 'Enviando mensaje, espere por favor',
      })
  });



  </script>
@endsection
