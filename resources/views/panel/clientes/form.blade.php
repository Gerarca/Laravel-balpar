@extends('layouts.panel')

@section('content')
  <div class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="RegisterValidation" action="{{$user->id?'/panel/clientes/'.$user->id:'/panel/clientes' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if ($user->id)
              {{ method_field('PATCH') }}
            @endif
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">{!! $user->id ? 'Editar cliente <b>'.$user->name.'</b>' : 'Añadir cliente' !!}</h4>
              </div>
              <div class="card-body ">
                <div class="form-group has-label">
                  <label for="nombre">
                    Nombre *
                  </label>
                  <input class="form-control" id="nombre" name="name" type="text" required="true" value="{{$user->name?$user->name:old('name')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="documento">
                    Número de documento *
                  </label>
                  <input class="form-control" id="documento" name="documento" type="text" required="true" value="{{$user->documento?$user->documento:old('documento')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="email">
                    Correo Electrónico *
                  </label>
                  <input class="form-control" id="email" name="email" type="email" required="true" value="{{$user->email?$user->email:old('email')}}"/>
                </div>

                <div class="form-group has-label">
                  <label for="calle_principal">
                    Calle principal
                  </label>
                  <input class="form-control" id="calle_principal" name="calle_principal" type="text" value="{{$user->calle_principal?$user->calle_principal:old('calle_principal')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="calle_secundaria">
                    Calle secundaria
                  </label>
                  <input class="form-control" id="calle_secundaria" name="calle_secundaria" type="text" value="{{$user->calle_secundaria?$user->calle_secundaria:old('calle_secundaria')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="telefono">
                    Teléfono fijo
                  </label>
                  <input class="form-control" id="telefono" name="telefono" type="text" value="{{$user->telefono?$user->telefono:old('telefono')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="celular">
                    Celular
                  </label>
                  <input class="form-control" id="celular" name="celular" type="text" value="{{$user->celular?$user->celular:old('celular')}}" />
                </div>
                <div class="form-group has-label">
                  <label for="cod_ciudad">
                    Ciudad
                  </label>
                  <select class="form-control select-2 "name="cod_ciudad" id="cod_ciudad" required="">
                    <?php
                      foreach ($array_ciudades as $posicion => $the_ciudad) {
                        ?>
                        <option value="<?php echo $the_ciudad['codigo_ciudad'] ?>" {{ ($user->cod_ciudad==$the_ciudad['codigo_ciudad'])?'selected=""':'' }} ><?php echo $the_ciudad['denominacion'].' ('.$the_ciudad['departamento_denominacion'].' - '.$the_ciudad['pais_denominacion'].')' ?></option>
                        <?php
                      }
                     ?>
                  </select>
                </div>
                <div class="form-group has-label">
                  <label for="barrio">
                    Barrio
                  </label>
                  <input class="form-control" id="barrio" name="barrio" type="text" value="{{$user->barrio?$user->barrio:old('barrio')}}" />
                </div>


                <div class="form-group has-label">
                  <label for="password">
                    Contraseña *
                  </label>
                  <input class="form-control" name="password" id="password" type="password" {{ $user->id ? '' : 'required="true"' }}  />
                </div>
                <div class="form-group has-label">
                  <label for="password_confirmation">
                    Confirmar Contraseña *
                  </label>
                  <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" {{ $user->id ? '' : 'required="true"' }} equalTo="#password" />
                </div>
                <div class="category form-category">* Campos requeridos</div>
              </div>
              <div class="card-footer text-right">

                <button type="submit" class="btn btn-primary">{{$user->exists ? 'Guardar cliente' : 'Crear nuevo cliente'}}</button>
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
