@extends('layouts.panel')

@section('content')
  <div class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="RegisterValidation" action="{{$solicitud->id ? route('solicitudtarjeta.update', $solicitud->id): route('solicitudtarjeta.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if ($solicitud->id)
              {{ method_field('PATCH') }}
            @endif
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">{!! $solicitud->id ? 'Editar Solicitud <b>'.$solicitud->name.'</b>' : 'Añadir Solicitud' !!}</h4>
              </div>
              <div class="card-body ">
                <div class="form-group has-label">
                  <label for="nombre">
                    Nombres
                  </label>
                  <input class="form-control" id="nombre" readonly name="nombre" type="text" required="true" value="{{$solicitud->nombre?$solicitud->nombre:old('nombre')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="apellido">
                    Apellidos
                  </label>
                  <input class="form-control" id="apellido" readonly name="apellido" type="text" required="true" value="{{$solicitud->apellido?$solicitud->apellido:old('apellido')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="email">
                    Email
                  </label>
                  <input class="form-control" id="email" readonly name="email" type="text" required="true" value="{{$solicitud->email?$solicitud->email:old('email')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="telefono">
                    Teléfono
                  </label>
                  <input class="form-control" id="telefono" readonly name="telefono" type="text" required="true" value="{{$solicitud->telefono?$solicitud->telefono:old('telefono')}}" />
                </div>

                <div class="form-group has-label">
                  <label for="celular">
                    Celular
                  </label>
                  <input class="form-control" id="celular" readonly name="celular" type="text" required="true" value="{{$solicitud->celular?$solicitud->celular:old('celular')}}" />
                </div>

                <div class="form-group has-label">
                  <label for="nacimiento">
                    Nacimiento
                  </label>
                  <input class="form-control" id="nacimiento" readonly name="nacimiento" type="text" required="true" value="{{$solicitud->nacimiento?date('Y/m/d',strtotime($solicitud->nacimiento)):date('Y/m/d',strtotime(old('ci')))}}" />
                </div>
                @if (strlen($solicitud->documento)>=1)
                  <div class="form-group has-label">
                    <label for="documento">
                      Documento
                    </label>
                    <a href="{{url('/uploads/'.$solicitud->documento)}}" target="_blank" download="" class="btn btn-primary btn-round btn-icon"><i class="fa fa-download"></i></a>

                  </div>

                @endif

                <div class="form-group has-label">
                  <label for="direccion">
                    Dirección
                  </label>
                  <input class="form-control" id="direccion" readonly name="direccion" type="text" required="true" value="{{$solicitud->direccion?$solicitud->direccion:old('direccion')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="ciudad">
                    Ciudad
                  </label>
                  <input class="form-control" id="ciudad" readonly name="ciudad" type="text" required="true" value="{{$solicitud->ciudad?$solicitud->ciudad:old('ciudad')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="trabajo">
                    Lugar de trabajo/Empresa
                  </label>
                  <input class="form-control" id="trabajo" readonly name="trabajo" type="text" required="true" value="{{$solicitud->trabajo?$solicitud->trabajo:old('trabajo')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="salario">
                    Salario
                  </label>
                  <input class="form-control" id="salario" readonly name="salario" type="text" required="true" value="{{$solicitud->salario?$solicitud->salario:old('salario')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="tarjeta_marca">
                    Marca de tarjeta de crédito en otras entidades
                  </label>
                  <input class="form-control" id="tarjeta_marca" readonly name="tarjeta_marca" type="text" required="true" value="{{$solicitud->tarjeta_marca?$solicitud->tarjeta_marca:old('tarjeta_marca')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="tarjeta_linea">
                    Línea en tarjeta de crédito en otras entidades
                  </label>
                  <input class="form-control" id="tarjeta_linea" readonly name="tarjeta_linea" type="text" required="true" value="{{$solicitud->tarjeta_linea?$solicitud->tarjeta_linea:old('tarjeta_linea')}}" />
                </div>



                <div class="form-group has-label">
                  <label for="estado">
                    Contactado
                  </label>
                  <input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="estado" {{$solicitud->estado==1?'checked':''}} data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                </div>


                <div class="category form-category">* Campos requeridos</div>
              </div>
              <div class="card-footer text-right">

                <button type="submit" class="btn btn-primary">{{$solicitud->exists ? 'Guardar solicitud' : 'Crear nueva solicitud'}}</button>
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
      function verificar_vencimineto(){
        var valor=$('#tipo_vencimiento').val();
        if (valor==1) {
          $('.solo-con-vencimiento').show();
        }else {
          $('.solo-con-vencimiento').hide();
        }
      }
      verificar_vencimineto();
      $('#tipo_vencimiento').change(function(){
        verificar_vencimineto();
      });

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
