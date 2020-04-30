@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="RegisterValidation" action="{{ route('testimonios.update', $testimonio->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Testimonio de <b>{{ $testimonio->nombre }}</b></h4>
                        </div>
                        <div class="card-body ">

                            <div class="card">
                                <div class="card-header">
                                    <b>{{ $testimonio->nombre }}</b>
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p class="card-text">{{ $testimonio->testimonio }}</p>
                                    </blockquote>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <input type="hidden" name="nombre" value="{{ $testimonio->nombre }}">
                            @if($testimonio->visible)
                                <input type="hidden" name="visible" value="0">
                                <button type="submit" class="btn btn-danger">Ocultar</button>
                                <a href="{{ route('testimonios.index') }}" class="btn btn-info">Cerrar</a>
                            @else
                                <input type="hidden" name="visible" value="1">
                                <button type="submit" class="btn btn-success">Mostrar</button>
                                <a href="{{ route('testimonios.index') }}" class="btn btn-info">Cerrar</a>
                            @endif
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
