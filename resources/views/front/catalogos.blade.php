@extends('layouts.front')
@section('title','Catálogos |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets_front/images/nosotros.jpg);">
    <h2 class="l-text2 t-center">
      Catálogos
    </h2>
  </section>

  <div class="container-fluid" style="background: #14488d;">
    <div class="row justify-content-center">
      <div class="col-6 col-md-3 anchor-item">
        <a href="#cat-1"><h5 class="anchor-links">Grupo 1</h5></a>
      </div>
      <div class="col-6 col-md-3 anchor-item">
        <a href="#cat-2"><h5 class="anchor-links">Grupo 2</h5></a>
      </div>
      <div class="col-6 col-md-3 anchor-item">
        <a href="#cat-3"><h5 class="anchor-links">Grupo 3</h5></a>
      </div>
      <div class="col-6 col-md-3 anchor-item">
        <a href="#cat-4"><h5 class="anchor-links">Grupo 4</h5></a>
      </div>
    </div>
  </div>


  <section class="p-b-50">
    <div class="container">

      <div id="cat-1" class="py-5">
        <h2 class="m-text17 text-color m-b-10 text-uppercase text-center">Grupo 1</h2>
        <div class="row row-sm">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="cat-2" class="py-5">
        <h2 class="m-text17 text-color m-b-10 text-uppercase text-center">Grupo 2</h2>
        <div class="row row-sm">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="cat-3" class="py-5">
        <h2 class="m-text17 text-color m-b-10 text-uppercase text-center">Grupo 3</h2>
        <div class="row row-sm">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="cat-4" class="py-5">
        <h2 class="m-text17 text-color m-b-10 text-uppercase text-center">Grupo 4</h2>
        <div class="row row-sm">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-5">
              <img src="{{url('assets_front/images/banner2.jpg')}}" class="card-img-top">
              <div class="card-body">
                <h3 class="card-title fs-18">Catálogo</h3>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" target="_blank" class="btn btn-primary btn-small" role="button"><i class="fas fa-eye"></i> Visualizar</a>
                <a href="{{url('assets_front/public/ejemplo.pdf')}}" download="" class="btn btn-secondary btn-small" role="button"><i class="fas fa-file-download"></i> Descargar</a>
              </div>
            </div>
          </div>
        </div>
      </div>

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
