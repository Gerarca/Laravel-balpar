@extends('layouts.front')
@section('title','Trabajos Realizados |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(assets_front/images/nosotros.jpg);">
    <h2 class="l-text2 t-center">
      Trabajos Realizados
    </h2>
  </section>

    <section class="p-t-40 p-b-30 bg-light">
      <h2 class="m-text17 text-color m-b-10"></h2>
      <div class="container-sm text-center" style="max-width:830px;">
        <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </section>

  <section class="works p-t-5 p-b-65 bg-light">
    <div class="container-sm">
      <div class="row">
        @foreach($trabajos as $trabajo)
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <div class="block3">
                <a class="block3-img">
                  <img src="{{url('uploads/'. $trabajo->imagen)}}" class="img-fluid">
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
