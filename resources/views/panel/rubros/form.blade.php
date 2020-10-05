@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$rubro->id ? route('rubros.update', $rubro->id): route('rubros.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($rubro->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $rubro->id ? 'Editar Rubro <b>'.$rubro->rubro.'</b>' : 'Añadir Rubro' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="categoria">
                                    Categoría *
                                </label>
                                <select id="categoria" name="categoria_id" class="form-control">
                                    <option></option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ $rubro->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group has-label">
                                <label for="rubro">
                                    Rubro *
                                </label>
                                <input class="form-control" id="rubro" name="rubro" type="text" required="true" value="{{ old('rubro', $rubro->rubro) }}" />
                            </div>
                            <div class="form-group has-label">
                                <label for="meta_image">
                                    Meta imagen
                                </label>
                                <div class="form-group">

                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ $rubro->meta_image ? url('uploads/'.$rubro->meta_image) : url('assets_template/img/image_placeholder.jpg') }}" alt="{{ $rubro->nombre?$rubro->nombre:old('nombre') }}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="meta_image" id="meta_image" {{ $rubro->id ? '' : 'required="true"' }} accept="image/*"/>
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
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="8" cols="80">{{ old('meta_description', $rubro->meta_description) }}</textarea>
                            </div>
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">{{$rubro->exists ? 'Guardar rubro' : 'Crear nuevo rubro'}}</button>
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
