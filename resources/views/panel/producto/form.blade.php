@extends('layouts.panel')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<form id="RegisterValidation" action="{{$producto->id ? route('producto.update', $producto->id): route('producto.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				@if (strlen($producto->id))
					@method('PUT')
				@endif
				<div class="card ">
					<div class="card-header ">
						<h4 class="card-title">{!! strlen($producto->id) ? 'Editar Producto <b>'.$producto->nombre.'</b>' : 'Añadir Producto' !!}</h4>
					</div>
					<div class="card-body">
						<div class="form-group has-label">
							<label>
								Categoria
							</label>
							<select id="categoria" class="form-control" name="categoria_id">
                                <option value="" selected disabled>Seleccionar categoría</option>
                                @foreach($categorias as $categoria)
                                    @if($producto->categoria)
                                        <option value="{{ $categoria->id }}" {{ $producto->categoria !== null && $categoria->id == $producto->categoria->id ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                                    @else
                                        <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                    @endif
                                @endforeach
                            </select>
						</div>
						<div class="form-group has-label">
							<label for="marca_id">
								Marca
							</label>
							<select class="form-control" id="marcas" name="marca_id" readonly="">
								@if($producto->id)
                                    @foreach($producto->categoria->marcas as $marca)
                                        <option value="{{ $marca->id }}" {{ $marca->id == $producto->marca_id ? 'selected' : '' }}>{{ $marca->nombre }}</option>
                                    @endforeach
                                @endif
							</select>
						</div>
						<div class="form-group has-label">
							<label for="uso_id">
								Uso
							</label>
							<select class="form-control" id="usos" name="uso_id" readonly="">
								@if($producto->id)
									@foreach($producto->categoria->usos as $uso)
										<option value="{{ $uso->id }}" {{ $uso->id == $producto->uso_id ? 'selected' : '' }}>{{ $uso->uso }}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="form-group has-label">
							<label for="rubro_id">
								Rubro
							</label>
							<select class="form-control" id="rubros" name="rubro_id" readonly="">
								@if($producto->id)
                                    @foreach($producto->categoria->rubros as $rubro)
                                        <option value="{{ $rubro->id }}" {{ $rubro->id == $producto->rubro_id ? 'selected' : '' }}>{{ $rubro->rubro }}</option>
                                    @endforeach
                                @endif
							</select>
						</div>
						<div class="form-group has-label">
							<label for="nombre">
								Nombre del Producto *
							</label>
							<input class="form-control" id="nombre" name="nombre" type="text" required="true" value="{{ old('nombre', $producto->nombre) }}" />
						</div>
						<div class="form-group has-label">
							<label for="subtitulo">
								Pequeña descripción *
							</label>
							<input class="form-control" id="subtitulo" name="subtitulo" type="text" required="true" value="{{ old('subtitulo', $producto->subtitulo) }}" />
						</div>
						<div class="form-group has-label">
							<label for="cod_articulo">
								Código de artículo *
							</label>
							<input class="form-control" id="cod_articulo" name="cod_articulo" type="text" required="true" value="{{ old('cod_articulo', $producto->cod_articulo) }}" />
						</div>
						<div class="form-group has-label">
							<label for="descripcion">
								Descripción
							</label>
							<div class="form-group">
								<textarea name="descripcion" id="descripcion" class="form-control ">{{ old('descripcion', $producto->descripcion) }}</textarea>
							</div>
						</div>
						<div class="form-group has-label">
							<label for="informacion">
								Información Adicional
							</label>
							<div class="form-group">
								<textarea name="informacion" id="informacion" class="form-control ">{{ old('informacion', $producto->informacion) }}</textarea>
							</div>
						</div>
						<div class="row">
                            <div class="col-md-3 col-sm-3">
                                <label for="imagen">
                                    Imagen Principal *
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$producto->imagen ? url('storage/productos/'.$producto->imagen):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$producto->titulo?$producto->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen" id="imagen" {{ $producto->imagen ? '' : 'required="true"' }} accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="imagen2">
                                    Imagen 2
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$producto->imagen2 ? url('storage/productos/'.$producto->imagen2):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$producto->titulo?$producto->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen2" id="imagen2" accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="imagen3">
                                    Imagen 3
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$producto->imagen3 ? url('storage/productos/'.$producto->imagen3):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$producto->titulo?$producto->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen3" id="imagen3" accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="imagen4">
                                    Imagen 4
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$producto->imagen4 ? url('storage/productos/'.$producto->imagen4):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$producto->titulo?$producto->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen4" id="imagen4" accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-group has-label">
							<label for="etiquetas">
								Etiquetas
							</label>
							<select class="form-control" id="etiquetas" name="etiquetas[]" multiple="">
								<option value="" selected disabled class="aux_select_2">Seleccionar etiquetas</option>
								@foreach($etiquetas as $etiqueta)
                                    <option value="{{ $etiqueta->id }}" {{ in_array($etiqueta->id, $producto->etiquetas->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $etiqueta->nombre }}</option>
                                @endforeach
							</select>
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
									<label for="destacado_comercial">
										Destacado comercial
									</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="destacado_comercial" id="destacado_comercial" {{$producto->destacado_comercial==1?'checked':''}} data-on-label="<i class='nc-icon nc-check-2'></i>"
											data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 col-sm-6 col-lg-3">
								<div class="form-group has-label">
									<label for="destacado_industrial">
										Destacado industrial
									</label>
									<div class="form-group">
										<input class="bootstrap-switch" type="checkbox" data-toggle="switch" id="destacado_industrial" name="destacado_industrial" {{$producto->destacado_industrial==1?'checked':''}} data-on-label="<i class='nc-icon nc-check-2'></i>"
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

  	<script>CKEDITOR.replace( 'descripcion' );</script>
  	<script>CKEDITOR.replace( 'informacion' );</script>

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

			@if($producto->id)
	            $("#marcas").select2({
	                placeholder: 'Seleccionar marca'
	            });
            @else
	            $("#marcas").select2({
	                placeholder: 'Seleccionar marca',
	                disabled: true
	            });
            @endif

			@if($producto->id)
	            $("#usos").select2({
	                placeholder: 'Seleccionar uso'
	            });
            @else
	            $("#usos").select2({
	                placeholder: 'Seleccionar uso',
	                disabled: true
	            });
            @endif

			@if($producto->id)
	            $("#rubros").select2({
	                placeholder: 'Seleccionar rubro'
	            });
            @else
	            $("#rubros").select2({
	                placeholder: 'Seleccionar rubro',
	                disabled: true
	            });
            @endif

			$("#etiquetas").select2({
          		tags: true,
          		tokenSeparators: [',', ' '],
          		language: "es",
          		multiple:"true",
          		placeholder: 'Seleccionar etiquetas'
      		});

			setTimeout(function () {
        		$('.aux_select_2').remove();
      		}, 50);

			$('#categoria').on('change', function () {
	            var valor = $(this).val();

	            $.ajax({
	                url: '{{ route('get.marcas') }}',
	                method: 'POST',
	                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
	                data: {valor: valor},
	                beforeSend: function () {
	                    $("#marcas").empty();
	                },
	                success: function (r) {

	                    $("#marcas").empty();
	                    $("#marcas").select2({
	                        placeholder: 'Seleccionar marca',
	                        disabled: false
	                    });

	                    if (r.length == 0) {
	                        $("#marcas").html('<option>Sin resultados</option>');
	                    }

	                    for (let i = 0; i < r.length; i++) {

	                        let marcas = `
	                            <option value="${r[i].id}">${r[i].nombre}</option>
	                        `;
	                        $("#marcas").append(marcas);
	                    }
	                }
	            });

				$.ajax({
	                url: '{{ route('get.usos') }}',
	                method: 'POST',
	                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
	                data: {valor: valor},
	                beforeSend: function () {
	                    $("#usos").empty();
	                },
	                success: function (r) {

	                    $("#usos").empty();
	                    $("#usos").select2({
	                        placeholder: 'Seleccionar uso',
	                        disabled: false
	                    });

	                    if (r.length == 0) {
	                        $("#usos").html('<option>Sin resultados</option>');
	                    }

	                    for (let i = 0; i < r.length; i++) {

	                        let usos = `
	                            <option value="${r[i].id}">${r[i].nombre}</option>
	                        `;
	                        $("#usos").append(usos);
	                    }
	                }
	            });

				$.ajax({
	                url: '{{ route('get.rubros') }}',
	                method: 'POST',
	                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
	                data: {valor: valor},
	                beforeSend: function () {
	                    $("#rubros").empty();
	                },
	                success: function (r) {

	                    $("#rubros").empty();
	                    $("#rubros").select2({
	                        placeholder: 'Seleccionar rubro',
	                        disabled: false
	                    });

	                    if (r.length == 0) {
	                        $("#rubros").html('<option>Sin resultados</option>');
	                    }

	                    for (let i = 0; i < r.length; i++) {

	                        let rubros = `
	                            <option value="${r[i].id}">${r[i].nombre}</option>
	                        `;
	                        $("#rubros").append(rubros);
	                    }
	                }
	            });

	        });

    	});
  	</script>

	<script>
		$("#img_input").on("change", function(){
			let form = $("#subir_fotos");
			form.submit();
		});
	</script>
@endsection
