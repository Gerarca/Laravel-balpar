@extends('layouts.panel')

@section('content')
  <div class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="RegisterValidation" action="{{$sucursal->id ? route('sucursal.update', $sucursal->id): route('sucursal.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if ($sucursal->id)
              {{ method_field('PATCH') }}
            @endif
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">{!! $sucursal->id ? 'Editar Sucursal <b>'.$sucursal->name.'</b>' : 'Añadir Sucursal' !!}</h4>
              </div>
              <div class="card-body ">
                <div class="form-group has-label">
                  <label for="titulo">
                    Titulo *
                  </label>
                  <input class="form-control" id="titulo" name="titulo" type="text" required="true" value="{{$sucursal->titulo?$sucursal->titulo:old('titulo')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="direccion">
                    Dirección
                  </label>
                  <input class="form-control" id="direccion" name="direccion" type="text" value="{{$sucursal->direccion?$sucursal->direccion:old('direccion')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="telefono">
                    Teléfono
                  </label>
                  <input class="form-control" id="telefono" name="telefono" type="text" value="{{$sucursal->telefono?$sucursal->telefono:old('telefono')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="mail">
                    Email
                  </label>
                  <input class="form-control" id="mail" name="mail" type="email" value="{{$sucursal->mail?$sucursal->mail:old('mail')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="mail">
                    Ubicación google maps <small>(vinculo de compartir)</small>
                  </label>
                  <input class="form-control" id="ubicacion" name="ubicacion" type="text" value="{{$sucursal->ubicacion?$sucursal->ubicacion:old('ubicacion')}}" url="true"/>
                </div>
                {{-- <div class="form-group has-label">
                  <label for="mail">
                    Iframe google maps <small>(url de Incorporar un mapa)</small>
                  </label>
                  <input class="form-control" id="iframe" name="iframe" type="text" value="{{$sucursal->iframe?$sucursal->iframe:old('iframe')}}"/>
                </div> --}}

                {{-- <div class="form-group has-label">

                  <div class="col-md-3 col-sm-4">
                    <label for="imagen">
                      Imágen
                    </label>
                    <div class="form-group">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle">
                          <img src="{{$sucursal->imagen?url('uploads/'.$sucursal->imagen):url('assets_template/img/placeholder.jpg')}}" alt="imagen">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                        <div>
                          <span class="btn btn-round btn-rose btn-file">
                            <span class="fileinput-new">Agregar foto</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="imagen" id="imagen" accept="image/*"/>
                          </span>
                          <br />
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}





                <div class="form-group has-label">
                  <label for="orden">
                    Prioridad
                  </label>
                  <select class="form-control" id="orden" name="orden">
                    @for ($i=1; $i <= $orden_maximo; $i++)
                      <option value="{{ $i }}" {{ $i==$sucursal->orden?'selected=""':''}}>{{$i}}</option>
                    @endfor
                  </select>
                </div>










                <div class="category form-category">* Campos requeridos</div>
              </div>
              <div class="card-footer text-right">

                <button type="submit" class="btn btn-primary">{{$sucursal->exists ? 'Guardar sucursal' : 'Crear nueva sucursal'}}</button>
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
