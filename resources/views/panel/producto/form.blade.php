@extends('layouts.panel')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<form id="RegisterValidation" action="{{$producto->id ? route('producto.update', $producto->cod_articulo): route('producto.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				@if (strlen($producto->cod_articulo))
				{{ method_field('PATCH') }}
				@endif
				<div class="card ">
					<div class="card-header ">
						<h4 class="card-title">{!! strlen($producto->cod_articulo) ? 'Editar Producto <b>'.$producto->name.'</b>' : 'Añadir Producto' !!}</h4>
					</div>
					<div class="card-body">
						<div class="form-group has-label">
							<label for="titulo">
								Titulo *
							</label>
							<input class="form-control" id="titulo" name="titulo" type="text" required="true" value="{{$producto->titulo?$producto->titulo:old('titulo')}}" readonly="" />
						</div>
						<div class="form-group has-label">
							<label for="cod_articulo">
								Código de artículo *
							</label>
							<input class="form-control" id="cod_articulo" name="cod_articulo" type="text" required="true" value="{{$producto->cod_articulo?$producto->cod_articulo:old('cod_articulo')}}"
								{{strlen($producto->cod_articulo)?'readonly=""':''}} />
						</div>
						<div class="form-group has-label">
							<label for="codigo_barra">
								Código de Barras
							</label>
							<input class="form-control" id="codigo_barra" name="codigo_barra" type="text" required="true" value="{{$producto->codigo_barra?$producto->codigo_barra:old('codigo_barra')}}"
								{{strlen($producto->codigo_barra)?'readonly=""':''}} />
						</div>
						<div class="form-group has-label">
							<label for="referencia">
								Referencia
							</label>
							<input class="form-control" id="referencia" name="referencia" type="text" required="true" value="{{$producto->referencia?$producto->referencia:old('referencia')}}" {{strlen($producto->referencia)?'readonly=""':''}} />
						</div>
						<div class="form-group has-label">
							<label for="stock">
								Stock
							</label>
							<input class="form-control" id="stock" name="stock" type="text" required="true" value="{{$producto->stock?$producto->stock:old('stock')}}" {{strlen($producto->stock)?'readonly=""':''}} />
						</div>
						<div class="form-group has-label">
							<label for="precio_retail">
								Precio Retail
							</label>
							<input class="form-control" id="precio_retail" name="precio_retail" type="text" required="true" value="{{$producto->precio_retail?$producto->precio():old('precio_retail')}}"
								{{strlen($producto->precio_retail)?'readonly=""':''}} />
						</div>

						<div class="form-group has-label">
							<label for="imagen">
								Imágen principal *
							</label>
							<div class="form-group">

								<div class="fileinput fileinput-new text-center" data-provides="fileinput">
									<div class="fileinput-new thumbnail">
										<img src="{{$producto->imagen ? url('storage/productos/'.$producto->imagen):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$producto->titulo?$producto->titulo:old('titulo')}}">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail"></div>
									<div>
			                          	<span class="btn btn-rose btn-round btn-file">
			                            	<span class="fileinput-new">Cambiar imagen principal</span>
			                            	<span class="fileinput-exists">Cambiar</span>
			                            	<input type="file" name="imagen" id="imagen" accept="image/*"/>
			                          	</span>
			                          	<a href="javascript:void(0)" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
											<i class="fa fa-times"></i> Quitar
										</a>
			                        </div>
								</div>
							</div>

						</div>

						<div class="form-group has-label">
							<label>
								Categoria
							</label>
							<div class="dropdown hierarchy-select" id="example-one">
								<button type="button" class="btn btn-secondary dropdown-toggle" id="example-one-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
								<div class="dropdown-menu" aria-labelledby="example-one-button">
									<div class="hs-searchbox">
										<input type="text" class="form-control" autocomplete="off">
									</div>
									<div class="hs-menu-inner">
										@foreach ($categorias as $categoria_list)
										@include('partials.categoria', ['categoria_list'=>$categoria_list, 'categoria_aux'=>'false'])
										@endforeach
									</div>
								</div>
								<input class="d-none" name="categoria_id" readonly="readonly" aria-hidden="true" type="text" />
							</div>
						</div>

						<div class="form-group has-label">
							<label for="marca_id">
								Marca
							</label>
							<select class="form-control" id="marca_id" name="marca_id" readonly="">
								@foreach ($marcas as $marca)
								<option value="{{$marca->id}}" {{$producto->marca_id==$marca->id?'selected=""':''}}>{{$marca->titulo}}</option>
								@endforeach
							</select>
							<input type="hidden" name="marca_id" value="{{$producto->marca_id}}">
						</div>
						<div class="form-group has-label">
							<label for="etiquetas">
								Etiquetas
							</label>
							<select class="form-control" id="etiquetas" name="etiquetas[]" multiple="">
								<option value="" selected disabled class="aux_select_2">Seleccionar etiquetas</option>
								@foreach ($etiquetas_seleccionadas as $ES)
									<option value="{{$ES->id}}" selected="">{{$ES->titulo}}</option>
								@endforeach
								@foreach ($etiquetas_no_seleccionadas as $ENS)
									<option value="{{$ENS->id}}">{{$ENS->titulo}}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group has-label">
							<label for="descripcion">
								Descripción
							</label>
							<div class="form-group">
								<textarea name="descripcion" id="descripcion" class="form-control ">{{$producto->descripcion?$producto->descripcion:old('descripcion')}}</textarea>
							</div>

						</div>
						<div class="form-group has-label">
							<label for="especificaciones">
								Especificaciones
							</label>
							<div class="form-group">
								<textarea name="especificaciones" id="especificaciones" class="form-control ">{{$producto->especificaciones?$producto->especificaciones:old('especificaciones')}}</textarea>
							</div>

						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6 col-sm-6 col-lg-3">
								<div class="form-group has-label">
									<label for="visible">
										Visible
									</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="visible" id="visible" {{$producto->visible==1?'checked':''}} data-on-label="<i class='nc-icon nc-check-2'></i>"
											data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 col-sm-6 col-lg-3">
								<div class="form-group has-label">
									<label for="oferta_semana">
										Marcar como oferta
									</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="oferta_semana" id="oferta_semana" {{$producto->oferta_semana==1?'checked':''}} data-on-label="<i class='nc-icon nc-check-2'></i>"
											data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 col-sm-6 col-lg-3">
								<div class="form-group has-label">
									<label for="recomendado">
										Marcar como recomendado
									</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" id="recomendado" name="recomendado" {{$producto->recomendado==1?'checked':''}} data-on-label="<i class='nc-icon nc-check-2'></i>"
											data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
									</div>
								</div>
							</div>
						</div>
						<div class="category form-category">* Campos requeridos</div>
						<hr>
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-primary">{{$producto->exists ? 'Guardar producto' : 'Crear nuevo producto'}}</button>
					</div>
				</div>
			</form>

			<div class="card">
				<div class="card-header ">
					<h4 class="card-title">Imágenes Secundarias</h4>
				</div>
				<div class="card-body">
					<form method="POST" id="subir_fotos" action="{{ route('producto.guardar.fotos', $producto->cod_articulo) }}" enctype="multipart/form-data">
						@csrf
						<div class="custom-file" style="width:80%; margin-left:10%">
							<input type="file" class="custom-file-input" lang="es" multiple name="imagenes_secundarias[]" id="img_input">
							<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
						</div>
					</form>

					<table class="table table-hover">
						<thead>
							<th></th>
							<th>Imagen</th>
							<th>Fecha de subida</th>
							<th></th>
						</thead>
						<tbody class="sortable" id="galeria_imagenes">
							{{-- Se inserta por ajax --}}
						</tbody>
				  	</table>
				</div>
				<div class="card-header ">
					<button class="btn btn-info float-right mr-1" id="editar_orden">Cambiar orden</button>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('especifico')

    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ url('assets_template/js/plugins/jasny-bootstrap.min.js') }}"></script>
  	<script src="{{ url('assets_template_extra/ckeditor/ckeditor.js') }}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
		$( function() {
			$(".sortable").sortable();
			$(".sortable").disableSelection();
		});
	</script>

	<script>
		function getFotosSecundarias() {
			let codigo_articulo = "{{ $producto->cod_articulo }}";
			const contenedor = $("#galeria_imagenes");
			$.ajax({
				type: 'GET',
				url: "{{ route('producto.obtener.galeria') }}",
				data: { codigo_articulo },
				beforeSend: function() {
					contenedor.empty();
				},
				success: function(data) {
					contenedor.append(data);
				}
			});
			return;
		}

		function deleteImagen(id) {
			var codigo_articulo = "{{ $producto->cod_articulo }}";
			$.ajaxSetup({
	   			headers: {
		   			'X-CSRF-TOKEN': "{{ csrf_token() }}"
	   			}
   			});
			$.ajax({
				type: 'POST',
				url: "{{ route('producto.eliminar.galeria') }}",
				data: { id },
				success: function() {
					$.notify({
	        			message: 'Se ha eliminado correctamente la imagen.'
	        		},{
	        			type: 'success'
	        		});
					getFotosSecundarias();
				}
			});
			return;
		}

		$(document).ready(function(){
			getFotosSecundarias();
		});
	</script>

	<script>
		$("#editar_orden").on("click", function(){
			let nuevo_orden = $('.sortable').sortable('toArray',  { attribute: 'data-id' });
			let id = "{{ $producto->cod_articulo }}";
			$.ajaxSetup({
	   			headers: {
		   			'X-CSRF-TOKEN': "{{ csrf_token() }}"
	   			}
   			});
			$.ajax({
				type: 'POST',
				url: "{{ route('producto.editar.galeria') }}",
				data: { id, nuevo_orden },
				success: function() {
					$.notify({
	        			message: 'Se ha editado correctamente el orden de las imágenes.'
	        		},{
	        			type: 'success'
	        		});
					getFotosSecundarias();
				}
			});
			return;
		});
	</script>

  	<script>CKEDITOR.replace( 'descripcion' );</script>
  	<script>CKEDITOR.replace( 'especificaciones' );</script>

	<link rel="stylesheet" href="{{ url('assets_template_extra/hierarchy-select-2/dist/hierarchy-select.min.css') }}">
  	<script src="{{ url('assets_template_extra/hierarchy-select-2/dist/hierarchy-select.min.js') }}"></script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#example-one').hierarchySelect({
	            width: 'auto'
	        });

	    });
	</script>

  	<script>
	    function setFormValidation(id) {
	      	$(id).validate({
		        highlight: function(element) {
		          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
		          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
		        },
		        success: function(element) {
		          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
		          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
		        },
		        errorPlacement: function(error, element) {
		          $(element).closest('.form-group').append(error);
		        },
	      	});
	    }

	    $(document).ready(function() {
			demo.initDateTimePicker();
			setFormValidation('#RegisterValidation');
			setFormValidation('#TypeValidation');
			setFormValidation('#LoginValidation');
			setFormValidation('#RangeValidation');

	      	@if($errors->any())
	        	@foreach ($errors->all() as $error)
	        		$.notify({
	        			message: '{{$error}}'
	        		},{
	        			type: 'danger'
	        		});
	        	@endforeach
	      	@endif
	      	@if (session()->has('mensaje'))
	      		$.notify({
	        		message: '{{ session()->get('mensaje') }}'
	      		},{
	        		type: 'success'
	      		});
	      	@endif
	    });
  	</script>

  	<script type="text/javascript">
    	$(document).ready(function(){
      		$('#cod_articulo').bind('input', function(){
        		$(this).val(function(_, v){
         			return v.replace(/\s+/g, '').replace('/', '');
        		});
      		});

      		$('#marca_id').select2({
          		language: "es",
          		disabled: true
        	});

	  		$("#etiquetas").select2({
          		tags: true,
          		tokenSeparators: [',', ' '],
          		language: "es",
          		multiple:"true",
          		placeholder: 'Seleccionar etiquetas'
      		});

	  		$("#tamanos").select2({
          		tags: true,
          		tokenSeparators: [',', ' '],
          		language: "es",
          		multiple:"true",
          		placeholder: 'Seleccionar tamaños',
      		});

	  		$("#colores").select2({
          		tags: true,
          		tokenSeparators: [',', ' '],
          		language: "es",
          		multiple:"true",
          		placeholder: 'Seleccionar colores',
      		});

			setTimeout(function () {
        		$('.aux_select_2').remove();
      		}, 50);
    	});
  	</script>

	<script>
		$("#img_input").on("change", function(){
			let form = $("#subir_fotos");
			form.submit();
		});
	</script>
@endsection
