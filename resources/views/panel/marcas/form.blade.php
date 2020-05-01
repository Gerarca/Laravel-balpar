@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$marca->id ? route('marcas.update', $marca->id): route('marcas.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($marca->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $marca->id ? 'Editar Marca <b>'.$marca->nombre.'</b>' : 'Añadir Marca' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="categoria">
                                    Categoría *
                                </label>
                                <select id="categoria" name="categoria_id" class="form-control">
                                    <option></option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ $marca->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group has-label">
                                <label for="nombre">
                                    Nombre *
                                </label>
                                <input class="form-control" id="nombre" name="nombre" type="text" required="true" value="{{ old('nombre', $marca->nombre) }}" />
                            </div>
                            <div class="form-group has-label">
                                <label for="imagen">
                                    Imagen *
                                </label>
                                <div class="form-group">

                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$marca->imagen ? url('uploads/'.$marca->imagen):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$marca->nombre?$marca->nombre:old('nombre')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Portada</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen" id="imagen" {{ $marca->id ? '' : 'required="true"' }} accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">{{$marca->exists ? 'Guardar marca' : 'Crear nueva marca'}}</button>
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

        $("#categoria").select2({
            placeholder: 'Seleccionar categoría'
        });

    });
    </script>

@endsection
