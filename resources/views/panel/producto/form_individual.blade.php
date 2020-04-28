@extends('layouts.panel')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<form id="RegisterValidation" action="{{ route('producto.guardar') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				@if (strlen($producto->cod_articulo))
					{{ method_field('PATCH') }}
				@endif
				<div class="card ">
					<div class="card-header ">
						<h4 class="card-title">Crear Producto</h4>
					</div>
					<div class="card-body ">

						<div class="form-group has-label">
							<label for="titulo"> Titulo * </label>
							<input class="form-control" id="titulo" name="titulo" type="text" required="true" value="{{ old('titulo') }}" />
						</div>
						<div class="form-group has-label">
							<label for="cod_articulo">
								Código de Artículo *
							</label>
							<input class="form-control" id="cod_articulo" name="cod_articulo" type="text" required="true" value="{{ old('cod_articulo') }}">
						</div>

						<div class="form-group has-label">
							<label for="codigo_barra"> Código de Barras </label>
							<input class="form-control" id="codigo_barra" name="codigo_barra" type="text" value="{{ old('codigo_barra') }}">
						</div>

						<div class="form-group has-label">
							<label for="referencia"> Referencia </label>
							<input class="form-control" id="referencia" name="referencia" type="text" value="{{ old('referencia') }}" />
						</div>

						<div class="form-group has-label">
							<label for="stock"> Stock</label>
							<input class="form-control" id="stock" name="stock" type="text" value="{{ old('stock') }}" />
						</div>

						<div class="form-group has-label">
							<label for="precio_retail">Precio Retail</label>
							<input class="form-control" id="precio_retail" name="precio_retail" type="text" value="{{ old('precio_retail') }}" />
						</div>

						<div class="form-group has-label">
							<label for="imagen">
								Imágen principal *
							</label>
							<div class="form-group">

								<div class="fileinput fileinput-new text-center" data-provides="fileinput">
									<div class="fileinput-new thumbnail">
										<img src="{{ url('assets_template/img/image_placeholder.jpg') }}">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail"></div>
									<div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Seleccionar imagen</span>
                                            <span class="fileinput-exists">Cambiar</span>
                                            <input type="file" required name="imagen_principal" id="imagen_principal" accept="image/*">
                                        </span>
                                        <a href="" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                            <i class="fa fa-times"></i> Quitar
                                        </a>
                                    </div>
								</div>
							</div>

						</div>

						{{-- <div class="form-group has-label">
							<label>Categoria</label>
							<div class="dropdown hierarchy-select" id="example-one">
								<button type="button" class="btn btn-secondary dropdown-toggle" id="example-one-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
								<div class="dropdown-menu" aria-labelledby="example-one-button">
									<div class="hs-searchbox">
										<input type="text" class="form-control" autocomplete="off">
									</div>
									<div class="hs-menu-inner">
										@foreach ($categorias as $categoria_list)
											@include('partials.categoria', ['categoria_list' => $categoria_list, 'categoria_aux' => 'false'])
										@endforeach
									</div>
								</div>
								<input class="d-none" name="categoria_id" aria-hidden="true" type="text" />
							</div>
						</div> --}}

						<div class="form-group has-label">
							<label for="marca_id">Marca</label>
							<select class="form-control" id="marca_id" name="marca_id">
								@foreach ($marcas as $marca)
									<option value="{{ $marca->id }}" {{ $producto->marca_id == $marca->id ? 'selected' : '' }}>{{ $marca->titulo }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group has-label">
							<label for="etiquetas">Etiquetas</label>
							<select class="form-control" id="etiquetas" name="etiquetas[]" multiple="">
								<option value="" selected disabled class="aux_select_2">Seleccionar etiquetas</option>
								@foreach ($etiquetas as $E)
									<option value="{{ $E->id}} ">{{ $E->titulo }}</option>
								@endforeach
							</select>
						</div>


						<div class="form-group has-label">
							<label for="descripcion">Descripción</label>
							<div class="form-group">
								<textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
							</div>
						</div>

						<div class="form-group has-label">
							<label for="especificaciones">Especificaciones</label>
							<div class="form-group">
								<textarea name="especificaciones" id="especificaciones" class="form-control ">{{ old('especificaciones') }}</textarea>
							</div>

						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6 col-sm-6 col-lg-3">
								<div class="form-group has-label">
									<label for="visible">Visible</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="visible" id="visible" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-md-6 col-sm-6 col-lg-3">
								<div class="form-group has-label">
									<label for="oferta_semana">Marcar como oferta</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="oferta_semana" id="oferta_semana" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-md-6 col-sm-6 col-lg-3">
								<div class="form-group has-label">
									<label for="recomendado">Marcar como recomendado</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" id="recomendado" name="recomendado" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
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
		</div>
	</div>
</div>
@endsection

@section('especifico')
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ url('assets_template/js/plugins/jasny-bootstrap.min.js') }}"></script>
<script src="{{ url('assets_template_extra/ckeditor/ckeditor.js') }}"></script>

<script>
	CKEDITOR.replace('descripcion');
</script>
<script>
	CKEDITOR.replace('especificaciones');
</script>

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
		@if ($errors-> any())
			@foreach ($errors-> all() as $error)
				$.notify({
					message: '{{$error}}'
				}, {
					type: 'danger'
				});
			@endforeach
		@endif
		@if (session()->has('mensaje'))
			$.notify({
				message: '{{ session()->get('
				mensaje ') }}'
			}, {
				type: 'success'
			});
		@endif
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#cod_articulo').bind('input', function() {
			$(this).val(function(_, v) {
				return v.replace(/\s+/g, '').replace('/', '');
			});
		});

		$('#marca_id').select2({
			language: "es",
			placeholder: 'Seleccionar marca'
		});
		$("#etiquetas").select2({
			tags: true,
			tokenSeparators: [',', ' '],
			language: "es",
			multiple: "true",
			placeholder: 'Seleccionar etiquetas'
		});
		$("#tamanos").select2({
			tags: true,
			tokenSeparators: [',', ' '],
			language: "es",
			multiple: "true",
			placeholder: 'Seleccionar tamaños',
		});
		$("#colores").select2({
			tags: true,
			tokenSeparators: [',', ' '],
			language: "es",
			multiple: "true",
			placeholder: 'Seleccionar colores',
		});
		setTimeout(function() {
			$('.aux_select_2').remove();
		}, 50);
	});
</script>

@endsection
