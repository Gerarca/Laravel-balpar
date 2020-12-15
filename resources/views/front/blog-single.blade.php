@extends('layouts.front')
@section('title',$blog->titulo.'|')
@section('content')
  <section class="blog_pnoticias">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-9">
          <div class="noticias-blog">
            <p class="fecha-pnoticias"><span class="clock-pnoticias"><i class="far fa-clock"></i>{{$blog->fecha_format}} </span> </p>
            <h2 class="title-pnoticias">{{$blog->titulo}}</h2>
            {{-- <p class="title-sub">Nos encontramos actualmente en proceso de implementación de las normas ISO 17025, para acreditación de laboratorios de ensayos y calibración de masas.</p> --}}

            <div class="compartir">
              <p class="title-articulo">Comparte este articulo:</p>
              <ul class="compartir-redes">
                <li>
                  <a href="#" class="facebook"> <span><i class="fab fa-facebook-f"></i></span> Compartir</a>
                </li>
                <li>
                  <a href="#" class="twitter"> <span><i class="fab fa-twitter"></i></span> Compartir</a>
                </li>

              </ul>
              <ul class="etiqueta-publicacion">
                  <li><p class="item-publicaciones"> <b> Por: {{$blog->user->name}} </b></p></li>
                  {{-- <li><p class="item-publicaciones">#Básculas Para Camiones</p></li> --}}
              </ul>
            </div>

            <div class="info">
              <div class=imagen-info>
                <img class="img-blog-pnoticias" src="{{$blog->imagen_url}}" alt="{{$blog->titulo}}">
              </div>
              <div class="contenido">
                <p class="parrafo-noticias">
                  {!! $blog->contenido !!}
                </p>
              </div>
            </div>
          </div>

          @if (count($tepuede_interesar))
            <div class="row interesar">
              <div class="col-md-12">
                <h4>Te puede interesar:</h4>
              </div>
              @foreach ($tepuede_interesar as $item)
                <div class="col-md-6">
                  <div class="card-interesar">
                    <div class="card-img">
                      <a href="{{$item->fullURL()}}">
                        <img class="img-blog" src="{{$item->imagen_url}}" alt="{{$item->titulo}}">
                      </a>
                    </div>
                    <div class="card-cuerpo">
                      <a href="{{$item->fullURL()}}" class="link-blog">
                        {{$item->titulo}}
                      </a>
                      <p>{!! $item->resumen_contenido !!}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

        </div>
        <div class="col-md-12 col-lg-3">
          <aside class="aside">
            <div class="aside-img">
              <img src="{{url('assets_front/images/asesoramiento.png')}}" alt="">
            </div>
            <div class="aside-info">
              <p class="title-aside" >Solicitar Asesoramiento</p>
              <p class="text-aside">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil tenetur dolor, libero temporibus doloribus quo perspiciatis itaque quaerat repellat sit minus atque consequuntur, nemo omnis modi, sint nesciunt vero iste?</p>
            </div>
            <div class="btn-asesoria">
              <a href="{{route('front.contacto')}}">Solicitar Asesoria</a>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
@endsection
