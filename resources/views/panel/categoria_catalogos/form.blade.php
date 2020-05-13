@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$categoria_catalogo->id ? route('categoria_catalogos.update', $categoria_catalogo->id): route('categoria_catalogos.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($categoria_catalogo->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $categoria_catalogo->id ? 'Editar Categoría <b>'.$categoria_catalogo->nombre.'</b> (<b>Catálogo</b>)' : 'Añadir Categoría (<b>Catálogo</b>)' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="nombre">
                                    Categoría *
                                </label>
                                <input class="form-control" id="nombre" name="nombre" type="text" required="true" value="{{ old('nombre', $categoria_catalogo->nombre) }}" />
                            </div>
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{$categoria_catalogo->exists ? 'Guardar categoria' : 'Crear nueva categoria'}}</button>
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
