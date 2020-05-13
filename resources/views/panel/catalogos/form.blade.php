@extends('layouts.panel')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<form id="RegisterValidation" action="{{$catalogo->id ? route('catalogos.update', $catalogo->id): route('catalogos.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				@if (strlen($catalogo->id))
					@method('PUT')
				@endif
				<div class="card ">
					<div class="card-header ">
						<h4 class="card-title">{!! strlen($catalogo->id) ? 'Editar Catálogo <b>'.$catalogo->nombre.'</b>' : 'Añadir Catálogo' !!}</h4>
					</div>
					<div class="card-body">
						<div class="form-group has-label">
							<label>
								Categoría
							</label>
							<select id="categoria" class="form-control" name="categoria_catalogo_id">
                                <option value="" selected disabled>Seleccionar categoría</option>
                                @foreach($categorias as $categoria)
                                    @if($catalogo->categoria)
                                        <option value="{{ $categoria->id }}" {{ $catalogo->categoria !== null && $categoria->id == $catalogo->categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                    @else
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
						</div>
						<div class="form-group has-label">
							<label for="nombre">
								Nombre del catálogo *
							</label>
							<input class="form-control" id="nombre" name="nombre" type="text" required="true" value="{{ old('nombre', $catalogo->nombre) }}" />
						</div>
						<div class="row">
                            <div class="col-md-3 col-sm-3">
                                <label for="imagen">
                                    Portada *
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$catalogo->imagen ? url('uploads/'.$catalogo->imagen):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$catalogo->titulo?$catalogo->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen" id="imagen" {{ $catalogo->imagen ? '' : 'required="true"' }} accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-group has-label">
                                <label for="archivo">
                                    Catalogo *
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            @if($catalogo->archivo != '')
                                                @php
                                                    $nombrePDF = substr($catalogo->archivo, 0);
                                                    $nombrePDF = substr($nombrePDF, 0, -15);
                                                    $nombrePDF = str_replace('-', ' ', $nombrePDF);
                                                    $nombrePDF = ucwords($nombrePDF);
                                                @endphp
                                                <a href="{{ url('uploads/'. $catalogo->archivo) }}" target="_blank"><i class="fa fa-file-pdf-o" style="font-size:25px;color:#51cbce"></i> {{ $nombrePDF }}</a>
                                            @else
                                                <img src="{{ url('assets_template/img/pdf_placeholder.jpg') }}">
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Archivo</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="archivo" id="archivo" accept=".pdf"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<div class="category form-category">* Campos requeridos</div>
						<hr>
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-primary">{{$catalogo->exists ? 'Guardar catalogo' : 'Crear nuevo catalogo'}}</button>
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
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
		$( function() {
			$(".sortable").sortable();
			$(".sortable").disableSelection();
		});
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

			$("#categoria").select2({
                placeholder: 'Seleccionar categoría'
            });

	    });
  	</script>

@endsection
