@extends('layouts.panel')

@section('content')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPfNoI2tMW80hyfLo4RB-L2M1Xsy34guk&libraries=places" defer></script>
  <div class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="RegisterValidation" action="{{route('pedidos.update', [$pedido->id])}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">Datos del pedido PED-{{$pedido->id}}</h4>
              </div>
              <div class="card-body ">
                <div class="form-group has-label">
                  <label for="nombre">
                    Cliente
                  </label>
                  <input class="form-control" id="nombre" name="nombre" type="text"value="{{$pedido->nombre}}" readonly="" />
                </div>
                <div class="form-group has-label">
                  <label for="email">
                    Email
                  </label>
                  <input class="form-control" id="email" name="email" type="text"value="{{$pedido->email}}" readonly="" />
                </div>
                <div class="form-group has-label">
                  <label for="telefono">
                    Telefono
                  </label>
                  <input class="form-control" id="telefono" name="telefono" type="text"value="{{$pedido->telefono}}" readonly="" />
                </div>
                <div class="form-group has-label">
                  <label for="empresa">
                    Empresa
                  </label>
                  <input class="form-control" id="empresa" name="empresa" type="text"value="{{$pedido->empresa}}" readonly="" />
                </div>
                <div class="form-group has-label">
                  <label for="created_at">
                    Fecha de Pedido
                  </label>
                  <input class="form-control" id="created_at" name="created_at" type="text"value="{{ date("d/m/Y H:i:s",strtotime($pedido->created_at))}}" readonly="" />
                </div>

                <div class="category form-category">* Campos requeridos</div>
              </div>
              <div class="card-footer text-right">
                @if($pedido->estado == 1)
                    <input type="hidden" name="estado" value="2">
                    <button type="submit" class="btn btn-warning">Actualizar estado</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-info">Cerrar</a>
                @else
                    <button type="button" class="btn btn-success">Realizado</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-info">Cerrar</a>
                @endif
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header ">
              <h4 class="card-title">Datos de Entrega</h4>
            </div>
            <div class="card-body ">
              @if (strlen($pedido->latitud)>=1 && strlen($pedido->longitud)>=1)
                <h5>Ubicación </h5>
              <div class="form-group">

								<div class="col-md-12">
									<div class="input-group col-sm-12">
										<input id="latitud" type="text" name="latitud" hidden="" value="{{$pedido->latitud }}">
										<input id="longitud" type="text" name="longitud" hidden="" value="{{$pedido->longitud }}">
										<div id="map" style="width: 100%; height: 300px" ></div>
									</div>
									<span class="help-block"></span>
								</div>
							</div>
              @endif

              <h5>Productos</h5>
              <div class="table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th>Cod. Artículo</th>
                    <th>Producto</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>

                  </tr>
                  @foreach ($pedido->detalles as $pos => $detalle)
                    <tr>
                      <td>{{$detalle->cod_articulo}}</td>
                      <td>{{$detalle->producto->titulo}} {{(strlen($detalle->variacion)>=1)?'['.$detalle->variacion.']':''}}</td>
                      <td><img src="{{ url('storage/productos/'.$detalle->producto->imagen) }}" alt="{{$detalle->producto->titulo}}" style="max-width:120px;"> </td>
                      <td>{{$detalle->printPrecio()}}</td>
                      <td>{{$detalle->cantidad}}</td>
                      <td>{{$detalle->printTotal()}}</td>

                    </tr>
                  @endforeach
                </table>
              </div>


            </div>
          </div>
        </div>



      </div>
    </div>
@endsection

@section('especifico')
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ url('assets_template/js/plugins/jasny-bootstrap.min.js') }}"></script>



<script type="text/javascript">
    $(document).ready(function() {

        $('.select-2').select2();

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

  <script type="text/javascript">
		$(document).ready(function(){
			var marker;
			var marker2;
      var latitud='-57.6336325';
 		 var longitud='-25.2826716';
			var mapProp = {
				center:new google.maps.LatLng(Number(longitud),Number(latitud)),
				zoom:16,
				mapTypeId:google.maps.MapTypeId.ROADMAP
			};
			var map=new google.maps.Map(document.getElementById("map"),mapProp);
			var pos = {
				lng: Number(latitud),
				lat: Number(longitud)
			};
			marker = new google.maps.Marker({
				position: pos,
				map: map,
				draggable:false,
				animation: google.maps.Animation.DROP
			});
			if ($('#latitud').val().length>=1 && $('#longitud').val().length>=1) {
				var pos = {
					lng: Number($('#latitud').val()),
					lat: Number($('#longitud').val())
				};

				map.setCenter(pos);
				marker.setPosition(pos);
			}else {


			}

			$('#crear_direccion').submit(function( event ) {
				// event.preventDefault();

				var lat = marker.getPosition().lat();
				var lng = marker.getPosition().lng();
				$('#longitud').val(lat);
				$('#latitud').val(lng);


			});
			$('#actualizar_direccion').submit(function( event ) {
				// event.preventDefault();

				var lat = marker.getPosition().lat();
				var lng = marker.getPosition().lng();
				$('#longitud').val(lat);
				$('#latitud').val(lng);


			});





			// input 1
			var input = document.getElementById('pac-input-1');
			var searchBox = new google.maps.places.SearchBox(input);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

			map.addListener('bounds_changed', function() {
				searchBox.setBounds(map.getBounds());
			});


			searchBox.addListener('places_changed', function() {
				var places = searchBox.getPlaces();
				if (places.length == 0) {
					return;
				}


				var bounds = new google.maps.LatLngBounds();
				places.forEach(function(place) {
					var icon = {
						url: place.icon,
						size: new google.maps.Size(71, 71),
						origin: new google.maps.Point(0, 0),
						anchor: new google.maps.Point(17, 34),
						scaledSize: new google.maps.Size(25, 25)
					};

					var pos = {
						lat: place.geometry.location.lat(),
						lng: place.geometry.location.lng()
					};
					map.setCenter(pos);
					marker.setPosition(pos);

					if (place.geometry.viewport) {
						// Only geocodes have viewport.
						bounds.union(place.geometry.viewport);
					} else {
						bounds.extend(place.geometry.location);
					}
				});
			});

		});

		</script>



@endsection
