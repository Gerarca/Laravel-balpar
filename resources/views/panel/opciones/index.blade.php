@extends('layouts.panel')

@section('content')
  <div class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Opciones</h5>
              </div>
              <div class="card-body">
                <form class="" action="{{route('panel.opciones.update')}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <ul id="tabs" class="nav nav-tabs" role="tablist">
                        @php $i = 0; @endphp
                        @foreach($object as $group)
                        @php $i++; @endphp
                        <li class="nav-item">
                          <a class="nav-link @if($i === 1) show active @endif" id="tab-{{ $i }}" data-toggle="tab" href="#tab-content-{{ $i }}" role="tab" aria-expanded="true"><span>{{ $group->name }}</span></a>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  <div id="my-tab-content" class="tab-content ">
                    @php $i = 0; @endphp
                    @foreach($object as $group)
                    @php $i++; @endphp
                    <div class="tab-pane  @if($i === 1) active show @endif" id="tab-content-{{ $i }}" role="tabpanel" aria-expanded="true">
                      @foreach($group->options as $key => $option)
                        @if($option->type == 'text' && $option->name <> 'carrusel_1' && $option->name <> 'carrusel_2')
                          <div class="form-group has-label">
                            <label for="option_{{$option->name}}">
                                @if($option->name == 'mail_pedido')
                                    Mail de confirmación de presupuesto (separado por commas para varios)
                                @else
                                    {!! $option->title !!}
                                @endif
                            </label>
                            <input class="form-control" id="option_{{$option->name}}" name="{{$option->name}}" type="text"  value="{{ $option->value }}" />
                          </div>

                        @endif
                        @if($option->type == 'percent')
                          <div class="form-group has-label">
                            <label for="option_{{$option->name}}">
                              {!! $option->title !!}
                            </label>
                            <input class="form-control" id="option_{{$option->name}}" name="{{$option->name}}" type="number" min="0" max="100" step="any"  value="{{ $option->value }}" />
                          </div>

                        @endif
                        @if($option->type == 'date')
                          <div class="form-group has-label">
                            <label for="option_{{$option->name}}">
                              {!! $option->title !!}
                            </label>
                            <input class="form-control datepicker" id="option_{{$option->name}}" name="{{$option->name}}" type="text"  value="{{(($option->value)) ? date('d/m/Y', strtotime($option->value)) : date('d/m/Y')}}" />
                          </div>

                        @endif

                        @if($option->type == 'flag')
                            <div class="form-group has-label">
                              <label for="option_{{$option->name}}">
                                {{ $option->title }}
                              </label>
                              <div class="form-group">

                                <select class="form-control" id="option_{{$option->name}}" name="{{$option->name}}" >
                                  <option value="1" {{ ($option->value==1)?'Selected=""':'' }}>HABILITADO</option>
                                  <option value="0" {{ ($option->value==0)?'Selected=""':'' }}>DESABILITADO</option>
                                </select>
                              </div>
                            </div>
                        @endif

                        {{-- @if($option->type == 'color')
                          <div class="form-group has-label">
                            <label for="option_{{$option->name}}">
                              {!! $option->title !!}
                            </label>
                            <input class="form-control" id="option_{{$option->name}}" name="{{$option->name}}" type="color"  value="{{ $option->value }}" style="padding: 0px;" />
                          </div>

                        @endif --}}
                        @if($option->type == 'imagen')
                          <div class="form-group has-label">
                            <label for="option_{{$option->name}}">
                              {!! $option->title !!}
                            </label>
                            <div class="form-group">

                              <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                  <img src="{{(strlen($option->value)>=1) ? url('uploads/'.$option->value):url('assets_template/img/image_placeholder.jpg')}}" alt="Logo">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                  <span class="btn btn-rose btn-round btn-file">
                                    <span class="fileinput-new">Seleccionar Imagen</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="file" name="{{$option->name}}" id="option_{{$option->name}}"  accept="image/*"/>
                                  </span>
                                  <a href="#pablo_{{$option->name}}" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                </div>
                              </div>
                            </div>
                            {{-- <input class="form-control" id="option_{{$option->name}}" name="{{$option->name}}" type="file"  accept="image/*" /> --}}
                          </div>

                        @endif


                      @endforeach

                    </div>
                    @endforeach
                  </div>
                  <button type="submit" name="button" class="btn btn-info">
                    <span class="btn-label">
                      <i class="nc-icon nc-settings-gear-65"></i>
                    </span>
                    Guardar Opciones</button>
                </form>
              </div>
            </div>
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
