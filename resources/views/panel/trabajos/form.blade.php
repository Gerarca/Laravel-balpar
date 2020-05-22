@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$trabajo->id ? route('trabajos.update', $trabajo->id): route('trabajos.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($trabajo->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $trabajo->id ? 'Editar Proyecto <b>'.$trabajo->nombre.'</b>' : 'Añadir Proyecto' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
    							<label>
    								Categoría
    							</label>
    							<select id="categoria" class="form-control" name="categoria_id">
                                    <option value="" selected disabled>Seleccionar categoría</option>
                                    @foreach($categorias as $categoria)
                                        @if($trabajo->categoria)
                                            <option value="{{ $categoria->id }}" {{ $trabajo->categoria !== null && $categoria->id == $trabajo->categoria->id ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                                        @else
                                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                        @endif
                                    @endforeach
                                </select>
    						</div>
                            <div class="form-group has-label">
                                <label for="nombre">
                                    Nombre del proyecto *
                                </label>
                                <input class="form-control" id="nombre" name="nombre" type="text" required="true" value="{{ old('nombre', $trabajo->nombre) }}" />
                            </div>
                            <div class="form-group has-label">
                                <label for="descripcion">
                                    Descripción *
                                </label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="8" cols="80">{{ old('descripcion', $trabajo->descripcion) }}</textarea>
                            </div>
                            <div class="form-group has-label">
                                <label for="imagen">
                                    Imagen *
                                </label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$trabajo->imagen ? url('uploads/'.$trabajo->imagen):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$trabajo->nombre?$trabajo->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen" id="imagen" {{ $trabajo->id ? '' : 'required="true"' }} accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">{{$trabajo->exists ? 'Guardar proyecto' : 'Crear nuevo proyecto'}}</button>
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
