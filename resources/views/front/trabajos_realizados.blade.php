@extends('layouts.front')
@section('title','Trabajos Realizados |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ url('assets_front/images/balpar_bannner.jpeg') }});">
    <h2 class="l-text2 t-center">
      Trabajos Realizados
    </h2>
  </section>

    <section class="p-t-40 p-b-30 bg-light">
      <h2 class="m-text17 text-color m-b-10"></h2>
      <div class="container-sm text-center" style="max-width:830px;">
          <p class="mb-3">Esta sección es una pequeña muestra de las instalaciones realizadas dedicada a los miles de clientes  que confiaron y dejaron en nuestras manos su proyecto.</p>
          <p class="mb-3">Nos alegra y llena de orgullo poder avanzar paso a paso juntos ofreciendo nuestros productos y servicios de la mas alta calidad, de forma útil y eficiente.</p>
          <p class="mb-3">Trabajando arduamente para dar soluciones a las demandas de cada uno de nuestros clientes.</p>
      </div>
    </section>

  <section class="works p-t-5 p-b-65 bg-light">
    <div class="container-sm">
      <div class="row">

          <div class="sidebar col-sm-6 col-md-4 col-lg-3 p-b-50">
              <div class="leftbar p-r-20 p-r-0-sm">

                  <h4 class="m-text11 p-b-7 font-weight-bold">
                      Categorías
                  </h4>
                  <ul>
                      @foreach($categorias_trabajos as $categoria_trabajos)
                          <li class="p-t-4">
                              <a href="{{ route('front.categoria_trabajos_realizados', ['categoria_trabajo' => $categoria_trabajos->id, 'nombre' => Str::slug($categoria_trabajos->categoria)]) }}" class="s-text13"
                                  @if(isset($marca))
                                      style="{{ $categoria_trabajos->id == $marca->id ? 'color: #12488f; font-weight: 500;' : '' }}"
                                  @endif
                                  >
                                  {{ $categoria_trabajos->categoria }}
                              </a>
                          </li>
                      @endforeach
                  </ul>


              </div>
          </div>

        @foreach($trabajos as $trabajo)
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <div class="block3">
                <a class="block3-img">
                    @if($trabajo->tipo == 1)
                        <img src="{{url('uploads/'. $trabajo->imagen)}}" class="img-fluid" loading="lazy">
                    @else
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="770" height="315" src="https://www.youtube.com/embed/{{ $trabajo->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
                        </div>
                    @endif
                </a>
                <div class="block3-txt p-4 bg-white">
                  <h5 class="p-b-7">{{ $trabajo->nombre }}</h5>
                  <small class="text-muted">{{ $trabajo->descripcion }}</small>
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection

@section('especifico')


@endsection
