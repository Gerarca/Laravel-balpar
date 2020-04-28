@extends('layouts.panel')

@section('content')
  	<div class="content">
      	<div class="row">
        	<div class="col-md-12">
          		<form id="RegisterValidation" action="" method="POST" enctype="multipart/form-data">
            		{{ csrf_field() }}
            		<div class="card">
              			<div class="card-header ">
                			<h4 class="card-title">Agregar Cuotas <small>{{ $producto->titulo }}</small></h4>
              			</div>

              			<div class="card-body">
							<table class="table table-striped table-bordered" cellspacing="0" style="margin:auto;width:80%">
	                            <thead>
	                                <tr>
										<th></th>
	                                    <th>Cantidad de Cuotas</th>
	                                    <th>Precio de la Cuota</th>
										<th></th>
	                                </tr>
	                            </thead>
	                            <tbody id="tabla_cuotas">
									@include('panel.cuotas.tabla-cuotas', ['producto' => $producto])
	                            </tbody>
	                        </table>
						</div>

						<div class="card-footer">
							<form method="POST" action="{{ route('panel.cuotas.store', $producto->cod_articulo) }}">
						  		<div class="row col-md-8" style="margin:auto">
							    	<div class="col">
							      		<input type="text" class="form-control" name="numero_cuotas" placeholder="Número de Cuotas">
						    		</div>
							    	<div class="col">
							      		<input type="text" class="form-control" name="monto_cuotas" placeholder="Monto de las Cuotas">
							    	</div>
									<div class="col">
										<button type="submit" class="btn btn-info">Agregar</button>
									</div>
							  	</div>
							</form>
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
		$(document).ready()
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
			        	// options
			        	message: '{{$error}}'
			        },{
			        	// settings
			        	type: 'danger'
			        });
        		@endforeach
      		@endif

      		@if(session()->has('mensaje'))
				$.notify({
				// options
				message: '{{ session()->get('mensaje') }}'
				},{
				// settings
				type: 'success'
				});
      		@endif
    	});
  	</script>
@endsection
