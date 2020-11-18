@extends('layouts.front')
@section('content')
    <section class="blog">
      <div class="container">
       
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="row">
              <div class="col-md-12 content-blog">
                <h2 class="title-blog">Últimas publicaciones</h2>

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
                      <p class="autor"> Por:<span> Balpar </span> </p>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <a href="{{route('front.blog_snoticia')}}">
                  <img class="img-blog" src="{{url('assets_front/images/bascula-instalada-en-produpar.jpeg')}}" alt="">
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
                      <a href="{{route('front.blog_snoticia')}}" class="link-blog"> 
                      Bascula Instalada en Produpar.
                      </a>
                      <p>Bascula Instalada en Produpar - Ciudad de Villeta.</p>
                      <p class="autor"> Por:<span> Balpar </span> </p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <a href="{{route('front.blog_tnoticia')}}">

                  <img class="img-blog" src="{{url('assets_front/images/bascula-de-hormigon-con-vigas-laterales-2.jpg')}}" alt="">
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
                      <a href="{{route('front.blog_tnoticia')}}" class="link-blog"> 
                      Bascula Entregada en la Constructora 8A Ciudad de Caaguazu.
                      </a>
                      <p>Bascula Entregada en la Constructora 8A en compañia del Ing. Recalde, residente de la Cantera.</p>
                      <p class="autor">  Por: <span> Balpar </span></p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <a href="{{route('front.blog_tnoticia')}}">

                  <img class="img-blog" src="{{url('assets_front/images/bascula-de-hormigon-con-vigas-laterales-2.jpg')}}" alt="">
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
                      <a href="{{route('front.blog_tnoticia')}}" class="link-blog"> 
                      Bascula Entregada en la Constructora 8A Ciudad de Caaguazu.
                      </a>
                      <p>Bascula Entregada en la Constructora 8A en compañia del Ing. Recalde, residente de la Cantera.</p>
                      <p class="autor">  Por: <span> Balpar </span></p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>


            <div class="row container-card">
              <div class="col-md-12 col-lg-5">
                <a href="{{route('front.blog_tnoticia')}}">

                  <img class="img-blog" src="{{url('assets_front/images/bascula-para-pesa-camiones.jpg')}}" alt="">
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
                      <a href="{{route('front.blog_tnoticia')}}" class="link-blog"> 
                      Bascula Pesa Camiones para Benito Roggio- Natalio - Paraguay
                      </a>
                      <p>Bascula Pesa Camiones para Benito Roggio - Natalio - Paraguay</p>
                      <p class="autor">  Por: <span> Balpar </span></p>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>

                <div class="row">
                  <div class="col-md-12 text-center mt-5">
                    <a class="btn-publicaciones" href="{{route('front.blog_todas')}}">Ver más publicaciones</a>
                  </div>
                </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <aside class="aside-buscador">
              <div class="contert-form">
                <form action="" class="form">
                  <input class="buscar" type="text" name="search" placeholder="Buscar">
                <button type="submit" class="btn-form">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                </form>
              </div>
              <div class="widget">
                <p class="title-widget">Categorías</p>
                <ul class="categorias-widget">
                  <li><a href="#">Testimonios</a></li>
                  <li><a href="#">Institucionales</a></li>
                  <li><a href="#">Productos</a></li>
                </ul>
              </div>

              
              <div class="etiquetas">
                <p class="title-widget">Etiquetas</p>
                <ul class="list-etiquetas">
                  <li><a href="">Góndolas y Almacenes</a></li>
                  <li><a href="">Pesaje Industrial</a></li>
                  <li><a href="">Basculas para camiones</a></li>
                </ul>
              </div>
            </aside>
            
          </div>
        </div>
      </div>
    </section>
@endsection