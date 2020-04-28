@extends('layouts.panel')

@section('content')
  <div class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="RegisterValidation" action="{{$categoria->id ? route('categoria.update', $categoria->id): route('categoria.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if ($categoria->id)
              {{ method_field('PATCH') }}
            @endif
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">{!! $categoria->id ? 'Editar Categoria <b>'.$categoria->name.'</b>' : 'Añadir Categoria' !!}</h4>
              </div>
              <div class="card-body ">
                <div class="form-group has-label">
                  <label for="titulo">
                    Titulo *
                  </label>
                  <input class="form-control" id="titulo" name="titulo" type="text" required="true" value="{{$categoria->titulo?$categoria->titulo:old('titulo')}}" />
                </div>


                <div class="form-group has-label">
                    <label for="imagen">
                      Imagen <small>(Recomendamos 800px X 500px)</small>
                    </label>
                    <div class="form-group">

                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="{{$categoria->imagen ? url('uploads/'.$categoria->imagen):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$categoria->titulo?$categoria->titulo:old('titulo')}}">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Seleccionar Imagen</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="imagen" id="imagen" accept="image/*"/>
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                        </div>
                      </div>
                    </div>


                </div>

                <div class="form-group has-label">
                  <label >
                    Categoria Padre
                  </label>
                  <div class="dropdown hierarchy-select" id="example-one">
                    <button type="button" class="btn btn-secondary dropdown-toggle" id="example-one-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="example-one-button">
                      <div class="hs-searchbox">
                        <input type="text" class="form-control" autocomplete="off">
                      </div>
                      <div class="hs-menu-inner">
                        <a class="dropdown-item" data-value="" data-level="1" {{ $categoria->id ?'':'data-default-selected=""'}} href="#">-- {{!$categoria->id ? 'Nueva':''}} categoria padre --</a>
                        @foreach ($categorias as $categoria_list)
                            @include('partials.categoria', ['categoria_list'=>$categoria_list, 'categoria_aux'=>'true'])
                        @endforeach


                      </div>
                    </div>
                    <input class="d-none" name="cod_padre" readonly="readonly" aria-hidden="true" type="text"/>
                  </div>

                </div>
                <div class="form-group has-label">
                  <label for="orden">
                    Prioridad
                  </label>
                  <select class="form-control" id="orden" name="orden">
                    @for ($i=1; $i <= $orden_maximo; $i++)
                      <option value="{{ $i }}" {{ $i==$categoria->orden?'selected=""':''}}>{{$i}}</option>
                    @endfor
                  </select>
                </div>










                <div class="category form-category">* Campos requeridos</div>
              </div>
              <div class="card-footer text-right">

                <button type="submit" class="btn btn-primary">{{$categoria->exists ? 'Guardar categoria' : 'Crear nuevo categoria'}}</button>
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
