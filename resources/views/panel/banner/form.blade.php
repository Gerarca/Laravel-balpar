@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$banner->id ? route('banner.update', $banner->id): route('banner.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($banner->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $banner->id ? 'Editar Banner <b>'.$banner->name.'</b>' : 'Añadir Banner' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="imagen">
                                    Imagen * <small>(Recomendamos 1920px X 580px)</small>
                                </label>
                                <div class="form-group">

                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$banner->imagen ? url('uploads/'.$banner->imagen):url('assets_template/img/image_placeholder.jpg')}}" alt="{{$banner->titulo?$banner->titulo:old('titulo')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="imagen" id="imagen" {{ $banner->id ? '' : 'required="true"' }} accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-label">
                                <label for="orden">
                                    Orden
                                </label>
                                <select class="form-control" id="orden" name="orden">
                                    @for ($i=1; $i <= $orden_maximo; $i++)
                                        <option value="{{ $i }}" {{ $i == $banner->orden ? 'selected' : ''}}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group has-label">
                                <label for="visible">
                                    Visible
                                </label>
                                <input class="bootstrap-switch" type="checkbox" data-toggle="switch" name="visible" {{$banner->visible == 1 ? 'checked' : ''}} data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
                            </div>
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">{{$banner->exists ? 'Guardar banner' : 'Crear nuevo banner'}}</button>
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
