@extends('layouts.panel')

@section('content')
  <div class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="RegisterValidation" action="{{$color->id?'/panel/color/'.$color->id:'/panel/color' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if ($color->id)
              {{ method_field('PATCH') }}
            @endif
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">{!! $color->id ? 'Editar Color <b>'.$color->name.'</b>' : 'Añadir Color' !!}</h4>
              </div>
              <div class="card-body ">
                <div class="form-group has-label">
                  <label for="titulo">
                    Titulo *
                  </label>
                  <input class="form-control" id="titulo" name="titulo" type="text" required="true" value="{{$color->titulo?$color->titulo:old('titulo')}}" />
                </div>


                <div class="form-group has-label">

                  <div class="col-md-3 col-sm-4">
                    <label for="logo">
                      Logo
                    </label>
                    <div class="form-group">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle">
                          <img src="{{$color->logo?url('uploads/'.$color->logo):url('assets_template/img/placeholder.jpg')}}" alt="logo">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                        <div>
                          <span class="btn btn-round btn-rose btn-file">
                            <span class="fileinput-new">Agregar foto</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="logo" id="logo" accept="image/*"/>
                          </span>
                          <br />
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="form-group has-label">
                    <label for="banner">
                      Banner
                    </label>
                    <div class="form-group">

                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="{{$color->banner ? url('uploads/'.$color->banner):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$color->titulo?$color->titulo:old('titulo')}}">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Seleccionar Banner</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="banner" id="banner" accept="image/*"/>
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                        </div>
                      </div>
                    </div>


                </div>


                <div class="form-group has-label">
                  <label for="orden">
                    Prioridad
                  </label>
                  <select class="form-control" id="orden" name="orden">
                    @for ($i=1; $i <= $orden_maximo; $i++)
                      <option value="{{ $i }}" {{ $i==$color->orden?'selected=""':''}}>{{$i}}</option>
                    @endfor
                  </select>
                </div>










                <div class="category form-category">* Campos requeridos</div>
              </div>
              <div class="card-footer text-right">

                <button type="submit" class="btn btn-primary">{{$color->exists ? 'Guardar color' : 'Crear nuevo color'}}</button>
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
