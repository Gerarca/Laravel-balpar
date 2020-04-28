@extends('layouts.front')
@section('title','Resultados de la búsqueda')
@section('content')


<main class="main">

	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-0">
		<div class="container container-large">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('front.index')}}">Inicio</a></li>

				<li class="breadcrumb-item active" aria-current="page">Resultados de la búsqueda: '{{ $request->s }}'</li>
			</ol>
		</div>
	</nav>

	<form class="" action="{{ route('front.buscar.principal')}}" id="form-filter" method="get">
		@csrf
		<div class="container container-large">
			<div class="row">
				<div class="col-lg-9">

					<nav class="toolbox mt-1">
						<div class="toolbox-left">
							<div class="toolbox-left hidden-lg">
								<div class="filter-toggle">
									<span>Filtros:</span>
									<a href=#>&nbsp;</a>
								</div>
							</div>
							<div class="toolbox-item toolbox-sort">
								<label>Ordenar:</label>

								<div class="select-custom">
									<select name="orderby" class="form-control">
										<option value="0" {{( isset($request->orderby) && (0 == $request->orderby))?'selected=""':''}} >Ordenar por</option>
                    <option value="1" {{( isset($request->orderby) && (1 == $request->orderby))?'selected=""':''}} >Precio de mayor a menor</option>
                    <option value="2" {{( isset($request->orderby) && (2 == $request->orderby))?'selected=""':''}} >Precio de menor a mayor</option>
									</select>
								</div>
							</div>
						</div>
					</nav>

					<div class="row row-sm product-grid">
						@forelse ($productos as $producto)
							<div class="col-6 col-md-4 col-xl-3">
								@include('partials.producto.index', $producto)
							</div>
						@empty
									<div class="col-12">
											Lo sentimos, no hemos encontrado resultados con los datos que elegiste.
											Intenta hacer otra búsqueda que de seguro tenemos cosas que te van a encantar.
									</div>
								@endforelse





					</div>

					<nav class="toolbox toolbox-pagination" id="pages">
            {{ $productos->appends(request()->input())->links() }}
          </nav>
				</div>
				<div class="sidebar-overlay"></div>
				<aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
					<div class="sidebar-wrapper">
						<div class="widget widget-search">
							<input type="search" class="form-control" placeholder="Buscar" value="{{$request->s}}" name="s" >
							<button type="submit" class="search-submit" title="Buscar">
								<i class="icon-search"></i>
								<span class="sr-only">Buscar</span>
							</button>
						</div>
						@if (sizeof($categorias_filtro)>=1)
						<div class="widget">
							<h3 class="widget-title">
								<a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1">Categorías</a>
							</h3>

							<div class="collapse show" id="widget-body-1">
								<div class="widget-body">
									<ul>
											@foreach ($categorias_filtro as $pos => $cat)
												<li>
													<div class="custom-control custom-checkbox ">
														<a href="{{ route('front.categorias.ver',[$cat->id,str_slug($cat->titulo)])}}">{{$cat->titulo}}</a>
													</div>

												</li>
											@endforeach
									</ul>

								</div>
							</div>
						</div>
					@endif
				


						<div class="widget">
                <a href="javascript:void(0);" id="filtrador_btn" class="btn btn-primary btn-close d-block ">Aplicar</a>
              </div>
					</div>
				</aside>
			</div>
		</div>
	</form>

	<div class="mb-5"></div>
</main>


@endsection
@section('especifico')
	<script type="text/javascript">
	$(document).ready(function() {
			$('#filtrador_btn').click(function(){
				$('#form-filter').submit();
			});
		});
	</script>
@endsection
