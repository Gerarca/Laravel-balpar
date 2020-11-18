@extends('layouts.front')
@section('content')
    <section class="blog">
      <div class="container">
       
        <div class="row">
          <div class="col-md-12 col-lg-9">
            <div class="row">
              <div class="col-md-12 content-blog">
                <h2 class="title-blog">Todas las publicaciones</h2>

              </div>
           </div>  
            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <a href="{{route('front.blog_pnoticia')}}">
                  <img class="img-blog" src="{{url('assets_front/images/balpar-se-encuentra.jpg')}}" alt="">
                </a>
              </div>
              <div class="col-md-12 col-lg-7">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contenido-card">
                      <div class="content-fecha">
                        <p class="etiqueta">#Básculas Para Camiones</p>
                        <p class="fecha">27/12/2018 <span class="clock"><i class="far fa-clock"></i></span> </p>
                      </div>
                      <a href="{{route('front.blog_pnoticia')}}" class="link-blog"> 
                      Implementación de la norma ISO 17025 como Laboratorio de Calibración de Masas y la ISO 9001.
                      </a>
                      <p>Nos encontramos actualmente en proceso de implementación de las normas ISO 17025, para acreditación de laboratorios de ensayos y calibración de masas.</p>
                      <p class="autor"> Por:<span> Balpar </span></p>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <img class="img-blog" src="{{url('assets_front/images/bascula-instalada-en-produpar.jpeg')}}" alt="">
              </div>
              <div class="col-md-12 col-lg-7">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contenido-card">

                      <div class="content-fecha">
                        <p class="etiqueta">#Básculas Para Camiones</p>
                        <p class="fecha">27/12/2018 <span class="clock"><i class="far fa-clock"></i></span> </p>
                      </div>
                      <a href="#" class="link-blog"> 
                      Bascula Instalada en Produpar.
                      </a>
                      <p>Bascula Instalada en Produpar - Ciudad de Villeta.</p>
                      <p class="autor">Por:<span> Balpar </span></p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <img class="img-blog" src="{{url('assets_front/images/bascula-de-hormigon-con-vigas-laterales-2.jpg')}}" alt="">
              </div>
              <div class="col-md-12 col-lg-7">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contenido-card">

                      <div class="content-fecha">
                        <p class="etiqueta">#Básculas Para Camiones</p>
                        <p class="fecha">27/12/2018 <span class="clock"><i class="far fa-clock"></i></span> </p>
                      </div>
                      <a href="#" class="link-blog"> 
                      Bascula Entregada en la Constructora 8A Ciudad de Caaguazu.
                      </a>
                      <p>Bascula Entregada en la Constructora 8A en compañia del Ing. Recalde, residente de la Cantera.</p>
                      <p class="autor">Por:<span> Balpar </span></p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <img class="img-blog" src="{{url('assets_front/images/bascula-de-hormigon-con-vigas-laterales-2.jpg')}}" alt="">
              </div>
              <div class="col-md-12 col-lg-7">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contenido-card">

                      <div class="content-fecha">
                        <p class="etiqueta">#Básculas Para Camiones</p>
                        <p class="fecha">27/12/2018 <span class="clock"><i class="far fa-clock"></i></span> </p>
                      </div>
                      <a href="#" class="link-blog"> 
                      Bascula Entregada en la Constructora 8A Ciudad de Caaguazu.
                      </a>
                      <p>Bascula Entregada en la Constructora 8A en compañia del Ing. Recalde, residente de la Cantera.</p>
                      <p class="autor">Por: <span> Balpar </span></p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <img class="img-blog" src="{{url('assets_front/images/bascula-de-hormigon-con-vigas-laterales-2.jpg')}}" alt="">
              </div>
              <div class="col-md-12 col-lg-7">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contenido-card">

                      <div class="content-fecha">
                        <p class="etiqueta">#Básculas Para Camiones</p>
                        <p class="fecha">27/12/2018 <span class="clock"><i class="far fa-clock"></i></span> </p>
                      </div>
                      <a href="#" class="link-blog"> 
                      Bascula Entregada en la Constructora 8A Ciudad de Caaguazu.
                      </a>
                      <p>Bascula Entregada en la Constructora 8A en compañia del Ing. Recalde, residente de la Cantera.</p>
                      <p class="autor">Por:<span> Balpar </span></p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-3"></div>
        </div>
      </div>
    </section>
@endsection