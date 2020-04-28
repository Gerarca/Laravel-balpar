@extends('layouts.panel')

@section('content')
  <div class="content">
    @if (isset(Auth::user()->roles()->first()->name) && Auth::user()->hasRole('Administrador'))
      <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Total vendido en el mes</p>
                      <p class="card-title">Gs. {{number_format ($total_mes,0,",",".")}}
                        <p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>


        <div class="col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-cart-simple text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Productos vendidos en el mes</p>
                      <p class="card-title">{{number_format ($cantidad_mes,0,",",".")}}
                        <p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Total vendido en el año</p>
                      <p class="card-title">Gs. {{number_format ($total_ano,0,",",".")}}
                        <p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>


        <div class="col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-cart-simple text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Productos vendidos en el año</p>
                      <p class="card-title">{{number_format ($cantidad_ano,0,",",".")}}
                        <p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

      </div>


    @endif
    <div class="row">
      <div class="col-md-3">

      </div>
      <div class="col-md-6">
            <div class="card card-user">
              <div class="image">
                <img src="{{ url('assets_template/img/bg/damir-bosnjak.jpg')}}" alt="aux_img">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    @if (strlen(Auth::user()->image)>=1)

                      <img class="avatar border-gray" src="{{ url('uploads/'.Auth::user()->image) }}" alt="aux_img">
                      @else
                        <img class="avatar border-gray" src="{{ url('assets_template/img/default-avatar.png') }}" alt="aux_img">

                    @endif
                    <h5 class="title">{{ Auth::user()->name }}</h5>
                  </a>
                  <p class="description">
                    {{ Auth::user()->email }}
                  </p>
                </div>

              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 ml-auto">
                      <h5>{{ Auth::user()->roles()->first()->name }}
                        <br>
                        <small>Rol</small>
                      </h5>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-3">

          </div>



    </div>





  </div>
@endsection
