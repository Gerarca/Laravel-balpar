@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$blog->id ? route('blog.update', $blog->id): route('blog.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($blog->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $blog->id ? 'Editar Blog <b>'.$blog->titulo.'</b>' : 'Añadir Blog' !!}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group has-label">
                							<label>Titulo *</label>
                							<input class="form-control" name="titulo" type="text" required="true" value="{{ old('titulo', $blog->titulo) }}" />
              						  </div>
                            <div class="form-group has-label">
                              <label>Contenido *</label>
                              <div class="form-group">
                                <textarea name="contenido" id="contenido" class="form-control ">{{ old('contenido', $blog->contenido) }}</textarea>
                              </div>
                            </div>
                            <div class="form-group has-label">
                							<label>Categoria *</label>
                							<select id="categoria" class="form-control categoria_list" name="categoria_id">
                                  <option value="" selected disabled>Seleccionar categoría</option>
                                  @foreach($categorias as $categoria)
                                      @if($blog->categoria)
                                          <option value="{{ $categoria->id }}" {{ $blog->categoria !== null && $categoria->id == $blog->categoria->id ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                                      @else
                                          <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                      @endif
                                  @endforeach
                              </select>
                						</div>
                            <div class="form-group has-label">
                                <label for="imagen">
                                    Imagen * <small>(Recomendamos 870px X 455px)</small>
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$blog->imagen ? $blog->imagen_url:url('assets_template/img/image_placeholder.jpg')}}" alt="{{$blog->titulo?$blog->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen" id="imagen" {{ $blog->id ? '' : 'required="true"' }} accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($blog->exists)
                              <div class="form-group has-label">
                                <label for="visible">
                                  Visible
                                </label>
                                <input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="visible" {{$blog->visible == 1 ? 'checked' : ''}} data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                              </div>
                            @endif
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">{{$blog->exists ? 'Guardar blog' : 'Crear nuevo blog'}}</button>
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
  	<script>CKEDITOR.replace( 'contenido' );</script>
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

      $(".categoria_list").select2({
        placeholder: 'Seleccionar categoría'
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
