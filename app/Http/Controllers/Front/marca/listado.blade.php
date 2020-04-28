@extends('layouts.front')
@section('title','Marcas')
@section('content')


<main class="main" id="main_marcas">
	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-0">
		<div class="container container-large">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('front.index')}}">Inicio</a></li>
				<li class="breadcrumb-item active" aria-current="page">Nuestras Marcas</li>
			</ol>
		</div>
	</nav>
	<div class="container-fluid infobox">
		<div class="row">
			<div class="col-lg-12">
				<div class="row row-sm">
          @foreach ($marcas as $pos => $marca)
            <div class="col-6 col-sm-4 col-md-3">
              <div class="partners">
                <figure class="product-image-container overflow-hidden">
                  <a href="{{ route('front.marcas.ver',[$marca->id,str_slug($marca->titulo)])}}"><img src="{{ url('uploads/'.$marca->logo) }}" alt="{{$marca->titulo}}"></a>
                </figure>

              </div>
            </div>

          @endforeach

				</div>
			</div>

		</div>
	</div>


<!--	<div class="mb-5"></div>-->
</main>


@endsection
@section('especifico')
<script src="{{url('assets_front/js/nouislider.min.js')}}"></script>

@endsection
