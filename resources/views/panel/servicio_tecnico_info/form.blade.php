@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{$servicio->id ? route('serviciovideos.update', $servicio->id): route('serviciovideos.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($servicio->id)
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $servicio->id ? 'Editar imagen/video Servicio Técnico' : 'Añadir imagen/video Servicio Técnico' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="type">
                                    Tipo *
                                </label>
                                <select name="type[]" id="type" data-recurso="1" class="form-control">
                                    <option value="">-- Seleccionar --</option>
                                    <option value="image" <?= (@$type[0] == 'image') ? 'selected' : '' ?> >Imagen</option>
                                    <option value="video" <?= (@$type[0] == 'video') ? 'selected' : '' ?> >Video</option>
                                </select>
                            </div>
                            <div class="form-group d-none <?= (@$type[0] == 'image') ? 'd-flex' : '' ?>" id="recurso-imagen-1">

                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{ $servicio->image1 ? url('uploads/'.$servicio->image1) :url('assets_template/img/image_placeholder.jpg')}}" >
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Seleccionar Imagen</span>
                                            <span class="fileinput-exists">Cambiar</span>
                                            <input type="file" name="image1" id="imagen"  accept="image/*"/>                                            
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-control  has-label d-none <?= (@$type[0] == 'video') ? 'd-flex' : '' ?>" id="recurso-video-1">
                                <label for="youtube1">
                                  Enlace de vídeo *
                                </label>
                                <input type="text" <?= (!empty(@$youtube_id[0])) ? "value='https://www.youtube.com/watch?v=$youtube_id[0]'" : '' ?> class="form-control" name="youtube[]" placeholder="https://www.youtube.com/watch?v=e83B_6IHC0Q">
                            </div>

                            <div class="category form-category">* Campos requeridos</div>
                        </div>                        
                    </div>
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{!! $servicio->id ? 'Editar imagen/video  Servicio Técnico' : 'Añadir imagen/video Servicio Técnico' !!}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="form-group has-label">
                                <label for="type">
                                    Tipo *
                                </label>
                                <select name="type[]" id="type" data-recurso="2" class="form-control">
                                    <option value="">-- Seleccionar --</option>
                                    <option value="image" <?= (@$type[1] == 'image') ? 'selected' : '' ?> >Imagen</option>
                                    <option value="video" <?= (@$type[1] == 'video') ? 'selected' : '' ?> >Video</option>
                                </select>
                            </div>
                            <div class="form-group d-none <?= (@$type[1] == 'image') ? 'd-flex' : '' ?>" id="recurso-imagen-2">

                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{ $servicio->image2 ? url('uploads/'.$servicio->image2):url('assets_template/img/image_placeholder.jpg')}}" >
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Seleccionar Imagen</span>
                                            <span class="fileinput-exists">Cambiar</span>
                                            <input type="file" name="image2" id="imagen"  accept="image/*"/>
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-control d-none has-label <?= (@$type[1] == 'video') ? 'd-flex' : '' ?>" id="recurso-video-2">
                                <label for="youtube2">
                                Enlace de vídeo *
                                </label>
                                <input type="text" class="form-control" name="youtube[]" <?= (!empty(@$youtube_id[1])) ? "value='https://www.youtube.com/watch?v=$youtube_id[1]'" : '' ?> placeholder="https://www.youtube.com/watch?v=e83B_6IHC0Q">
                            </div>

                            <div class="category form-category">* Campos requeridos</div>
                        </div>                        
                    </div>
                    <div class="card">
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{$servicio->exists ? 'Guardar Video/Imagen' : 'Crear nuevo'}}</button>
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
      
      $("select[name='type[]']").change(function(){
        let recurso = $(this).data("recurso");
        let selectVal = $(this).val();

        if(selectVal == 'image'){        
          $(`#recurso-imagen-${recurso}`).addClass("d-flex");
          $(`#recurso-video-${recurso}`).removeClass("d-flex");
        }else{
          $(`#recurso-video-${recurso}`).addClass("d-flex");
          $(`#recurso-imagen-${recurso}`).removeClass("d-flex");
        } 
      });

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
