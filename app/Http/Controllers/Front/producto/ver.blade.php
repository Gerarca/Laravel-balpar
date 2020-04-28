@extends('layouts.front')
@section('title',$producto_actual->titulo)
@section('content')


	<main class="main">
		<nav aria-label="breadcrumb" class="breadcrumb-nav">
			<div class="container container-large">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('front.index')}}">Inicio</a></li>
					@foreach ($categorias_aux as $cat)
                <li class="breadcrumb-item"><a href="{{ route('front.categorias.ver',[$cat->id,str_slug($cat->titulo)])}}">{{ $cat->titulo }}</a></li>
            @endforeach
						<li class="breadcrumb-item"><a href="{{ route('front.categorias.ver',[$producto_actual->categoria->id,str_slug($producto_actual->categoria->titulo)])}}">{{ $producto_actual->categoria->titulo }}</a></li>

					<li class="breadcrumb-item active" aria-current="page">{{$producto_actual->titulo}}</li>
				</ol>
			</div>
		</nav>
		<div class="container container-large">
			<div class="row">
				<div class="col-lg-12">
					<div class="product-single-container product-single-default">
						<div class="row">
							<div class="col-lg-7 col-md-6">
								<div class="product-single-gallery">
									<div class="product-slider-container product-item">
										<div class="product-single-carousel owl-carousel owl-theme">


											<div class="product-item">
												<img class="product-single-image" src="{{ url('storage/productos/'.$producto_actual->imagen) }}"  data-zoom-image="{{ url('storage/productos/'.$producto_actual->imagen) }}" />
											</div>
											@if (sizeof($producto_actual->imagenes)>=1)
												@foreach ($producto_actual->imagenes as $pos => $image)
													<div class="product-item">
														<img class="product-single-image" src="{{ url('storage/productos/'.$image->imagen) }}" data-zoom-image="{{ url('storage/productos/'.$image->imagen) }}"/>
													</div>
												@endforeach
											@endif
										</div>

										<span class="prod-full-screen">
											<i class="icon-plus"></i>
										</span>
									</div>
									<div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
										<div class="col-3 col-md-2 owl-dot">
											<img src="{{ url('storage/productos/'.$producto_actual->imagen) }}" />
										</div>
										@if (sizeof($producto_actual->imagenes)>=1)
											@foreach ($producto_actual->imagenes as $pos => $image)
												<div class="col-3 col-md-2 owl-dot">
													<img src="{{ url('storage/productos/'.$image->imagen) }}" />
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>

							<div class="col-lg-5 col-md-6">
								<div class="product-single-details">
									<div class="d-flex justify-content-between mb-1">
										<h5 class="m-0 font-weight-bold"><a href="{{ route('front.marcas.ver',[$producto_actual->marca->id,str_slug($producto_actual->marca->titulo)])}}" class="text-muted">{{$producto_actual->marca->titulo}}</a></h5>
										<h5 class="m-0 font-weight-light">Código del producto (SKU): {{$producto_actual->sku}}</h5>
									</div>
									<h1 class="product-title">{{$producto_actual->titulo}}</h1>

									<div class="price-box d-flex justify-content-between">
										<div class="">
											<span class="product-price oferta d-flex">{{$producto_actual->precio()}}</span>
										</div>

										<a href="#" class="d-flex w-25" data-toggle="modal" data-target="#modal_calc">
										<img src="{{url('assets_front/images/calc.svg')}}" style="height:32px;">
										<h6>Calculá tu cuota con tu Tarjeta NA</h6>
									</a>


									</div>

									<div class="product-desc">
										<p>
											<strong>Categoría: </strong> <a href="{{ route('front.categorias.ver',[$producto_actual->categoria->id,str_slug($producto_actual->categoria->titulo)])}}">{{$producto_actual->categoria->titulo}}</a>
										</p>
									</div>

									<div class="product-action">
										<div class="row w-100">
											<div class="col-lg-4 col-md-5 col-4 px-0">
												<div class="product-single-qty">
													<input class="horizontal-quantity form-control" type="number" max="{{$producto_actual->stock}}" min="1" id="cantidad_input">
												</div>
											</div>

											<div class="col-lg-8 col-md-7 col-8 pr-0">
												<a href="javascript:void(0)" class="paction add-cart btn-primary w-100" data-prod="{{$producto_actual->cod_articulo}}">
													<span>Agregar al carrito</span>
												</a>
											</div>
										</div>
									</div>

								</div>
								<div class="codigos item-link-wrapper pt-5 d-none d-lg-flex justify-content-between">
									<h5 class="m-0 font-weight-light ">Número del referencia: {{$producto_actual->referencia}}</h5>
									<h5 class="m-0 font-weight-light">Número de código de barra: {{$producto_actual->codigo_barra}}</h5>
								</div>
							</div>
						</div>
					</div>
					@if (strlen($producto_actual->descripcion)>=1 || strlen($producto_actual->especificaciones)>=1)
						<div class="product-single-tabs">
							<ul class="nav nav-tabs" role="tablist">
								@if (strlen($producto_actual->descripcion)>=1)
									<li class="nav-item">
										<a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Detalles</a>
									</li>
								@endif
								@if (strlen($producto_actual->especificaciones)>=1)
									<li class="nav-item">
										<a class="nav-link {{(!strlen($producto_actual->descripcion)>=1)?'active':''}}" id="product-tab-size" data-toggle="tab" href="#product-size-content" role="tab" aria-controls="product-size-content" aria-selected="false">Especificaciones</a>
									</li>
								@endif
							</ul>
					<div class="tab-content">
						@if (strlen($producto_actual->descripcion)>=1)
							<div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
								<div class="product-desc-content">
									{!!$producto_actual->descripcion!!}
								</div>
							</div>
						@endif
						@if (strlen($producto_actual->especificaciones)>=1)
							<div class="tab-pane fade {{(!strlen($producto_actual->descripcion)>=1)?' show active':''}}" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
								<div class="product-size-content">
									{!!$producto_actual->especificaciones!!}
								</div>
							</div>
						@endif
					</div>
				</div>
					@endif

				</div>
			</div>

			<div class="product-single-tabs pt-3">
				<ul class="nav nav-tabs" role="tablist">
					@if(sizeof($productos_relacionados)>=1)
						<li class="nav-item">
							<a class="nav-link active" id="tab-interes" data-toggle="tab" href="#tab-interes-content" role="tab" aria-controls="tab-interes-content" aria-selected="true">Productos Similares</a>
						</li>
					@endif
					@if(sizeof($estilo_con)>=1)
						<li class="nav-item">
							<a class="nav-link {{ !sizeof($productos_relacionados)>=1?'active':''  }}" id="tab-similares" data-toggle="tab" href="#tab-similares-content" role="tab" aria-controls="tab-similares-content" aria-selected="false">También te puede interesar</a>
						</li>
					@endif
				</ul>
				<div class="tab-content">
					@if(sizeof($productos_relacionados)>=1)
						<div class="tab-pane fade show active" id="tab-interes-content" role="tabpanel" aria-labelledby="tab-interes">
							<div class="product-desc-content">
								<div class="featured-products owl-carousel owl-theme owl-dots-top">
									@foreach ($productos_relacionados as $producto)
                      @include('partials.producto.index', $producto)
                  @endforeach
								</div>
							</div>
						</div>
					@endif

					@if(sizeof($estilo_con)>=1)
						<div class="tab-pane fade {{ !sizeof($productos_relacionados)>=1?'show active':''  }}" id="tab-similares-content" role="tabpanel" aria-labelledby="tab-similares">
							<div class="product-desc-content">
								<div class="featured-products owl-carousel owl-theme owl-dots-top">
									@foreach ($estilo_con as $producto)
											@include('partials.producto.index', $producto)
									@endforeach
								</div>
							</div>
						</div>
					@endif


				</div>
			</div>


			<div class="mb-lg-4"></div>
		</div>

	</main>

@endsection
@section('especifico')

@endsection
