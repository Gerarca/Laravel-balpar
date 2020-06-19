@extends('layouts.panel')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('nosotros.update') }}" method="POST" id="paperForm" class="form-validate" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Nosotros</h4>
                        </div>
                        <div class="card-body ">
                            <fieldset style="border: 1px solid #cecece; padding: 20px; border-radius: 10px">
                                <legend style="display: inline; width: auto; padding: 0 20px">Video</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($nosotros->video)
                                            <iframe src="https://www.youtube.com/embed/{{ $nosotros->video }}" style="width: 100%; height: 300px; border: 0"></iframe>
    									@else
    										<div class="text-center" style="height:300px; padding-top:140px">
    											<p>No posee ningun video aún, agrégalo con el formulario de abajo.</p>
    										</div>
    									@endif
                                        {{-- <div class="form-group">
                                            <label for="video">ID del video</label>
                                            <input type="text" name="video" id="video" class="form-control" value="{{ old('video', $nosotros->video) }}">
                                        </div> --}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                                            </div>
                                            <input type="text" name="video" value="{{ old('video', $nosotros->video) }}" class="form-control" pattern="[a-zA-Z0-9-_]{11}" placeholder="d0TZ6OUmlcw" title="Hasta 11 caracteres">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">Actualizar Datos</button>
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

        });
    </script>
@endsection
