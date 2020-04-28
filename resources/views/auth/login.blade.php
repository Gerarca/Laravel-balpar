@extends('layouts.app')

@section('content')
  <div class="content">
    <div class="container">
      <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form  class="form" method="POST" action="{{ route('login') }}">
            @csrf
          <div class="card card-login">
            <div class="card-header ">
              <div class="card-header ">
                <h3 class="header text-center">Ingresar</h3>
              </div>
            </div>
            <div class="card-body ">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="nc-icon nc-single-02"></i>
                  </span>
                </div>
                <input id="email" placeholder="Nombre..." type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="nc-icon nc-key-25"></i>
                  </span>
                </div>
                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
              <br/>

            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-warning btn-round btn-block mb-3">Ingresar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <style media="screen">
  .wrapper.wrapper-full-page {
    min-height: 100vh;
    height: auto; }
  </style>
@endsection
