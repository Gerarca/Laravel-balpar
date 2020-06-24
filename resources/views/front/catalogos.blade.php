@extends('layouts.front')
@section('title','Catálogos |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ url('assets_front/images/balpar_bannner.jpeg') }});">
    <h2 class="l-text2 t-center">
      Catálogos
    </h2>
  </section>

  <div class="container-fluid" style="background: #14488d;">
    <div class="row justify-content-center">
        @foreach($categoria_catalogos as $categoria_catalogo)
          <div class="col-6 col-md-3 anchor-item">
            <a href="#cat-{{ $categoria_catalogo->id }}"><h5 class="anchor-links">{{ $categoria_catalogo->nombre }}</h5></a>
          </div>
        @endforeach
    </div>
  </div>


  <section class="p-b-50">
    <div class="container">
        @foreach($categoria_catalogos as $categoria_catalogo_dos)
          <div id="cat-{{ $categoria_catalogo_dos->id }}" class="py-5">
            <h2 class="m-text17 text-color m-b-10 text-uppercase text-center">{{ $categoria_catalogo_dos->nombre }}</h2>
            <div class="row row-sm">

                @foreach($categoria_catalogo_dos->catalogos as $catalogo)
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="card mb-5">
                      <img src="{{url('uploads/'. $catalogo->imagen)}}" class="card-img-top">
                      <div class="card-body">
                        <h3 class="card-title fs-18">{{ $catalogo->nombre }}</h3>
                      </div>
                      <div class="card-footer d-flex justify-content-between">
                        <a href="{{url('uploads/'. $catalogo->archivo)}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                        <a href="{{url('uploads/'. $catalogo->archivo)}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
                      </div>
                    </div>
                  </div>
                @endforeach

            </div>
          </div>
        @endforeach

    </div>
  </section>
@endsection

@section('especifico')
<script type="text/javascript">
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth',
        block: 'center'
      });
    });
  });

</script>
@endsection
