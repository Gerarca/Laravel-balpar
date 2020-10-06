@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$categoria->id ? route('categorias.update', $categoria->id): route('categorias.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($categoria->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $categoria->id ? 'Editar Categoría <b>'.$categoria->categoria.'</b>' : 'Añadir Categoría' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="categoria">
                                    Categoría *
                                </label>
                                <input class="form-control" id="categoria" name="categoria" type="text" required="true" value="{{ old('categoria', $categoria->categoria) }}" />
                            </div>
                            <div class="form-group has-label">
                                <label for="meta_image">
                                    Meta imagen
                                </label>
                                <div class="form-group">

                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ $categoria->meta_image ? url('uploads/'.$categoria->meta_image) : url('assets_template/img/image_placeholder.jpg') }}" alt="{{ $categoria->nombre?$categoria->nombre:old('nombre') }}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="meta_image" id="meta_image" {{ $categoria->id ? '' : 'required="true"' }} accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-label">
                                <label for="meta_description">
                                    Meta descripción
                                </label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="8" cols="80">{{ old('meta_description', $categoria->meta_description) }}</textarea>
                            </div>
                            <div class="form-group has-label">
                                <label for="meta_keywords">
                                    Palabras clave (Separados por coma. Ejemplo: pesaje industrial, pesaje comercial, insumos)
                                </label>
                                <input class="form-control" id="meta_keywords" name="meta_keywords" type="text" value="{{ old('meta_keywords', $categoria->meta_keywords) }}" placeholder="pesaje industrial, pesaje comercial, insumos"/>
                            </div>
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{$categoria->exists ? 'Guardar categoria' : 'Crear nueva categoria'}}</button>
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
