@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{ route('datos_dinamicos.update', $datos_dinamico->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Editar Datos Dinamicos</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="years">
                                    Años de Trayectoria *
                                </label>
                                <input class="form-control" id="years" name="years" type="text" required="true" value="{{ $datos_dinamico->years }}" />
                            </div>
                            <div class="form-group has-label">
                                <label for="clientes">
                                    Clientes Satisfechos *
                                </label>
                                <input class="form-control" id="clientes" name="clientes" type="text" required="true" value="{{ $datos_dinamico->clientes }}" />
                            </div>
                            <div class="form-group has-label">
                                <label for="trabajos">
                                    Fuentes de Trabajo *
                                </label>
                                <input class="form-control" id="trabajos" name="trabajos" type="text" required="true" value="{{ $datos_dinamico->trabajos }}" />
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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

    <script>CKEDITOR.replace( 'descripcion' );</script>

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
