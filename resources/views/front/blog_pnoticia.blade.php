@extends('layouts.front')
@section('content')
  <section class="blog_pnoticias">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-9">
          <div class="noticias-blog">
            <p class="fecha-pnoticias"><span class="clock-pnoticias"><i class="far fa-clock"></i>27/12/2018 </span> </p>
            <h2 class="title-pnoticias">Implementación de la norma ISO 17025 como Laboratorio de Calibración de Masas y la ISO 9001.</h2>
            <p class="title-sub">Nos encontramos actualmente en proceso de implementación de las normas ISO 17025, para acreditación de laboratorios de ensayos y calibración de masas.</p>

            <div class="compartir">
              <p class="title-articulo">Comparte este articulo:</p>
              <ul class="compartir-redes">
                <li>
                  <a href="#" class="facebook"> <span><i class="fab fa-facebook-f"></i></span> Compartir</a>
                </li>
                <li>
                  <a href="#" class="twitter"> <span><i class="fab fa-twitter"></i></span> Compartir</a>
                </li>
                
              </ul>
              <ul class="etiqueta-publicacion">
                
                  <li><p class="item-publicaciones"> <b> Por: Balpar </b></p></li>
                  <li><p class="item-publicaciones">#Básculas Para Camiones</p></li>
                
              </ul>
            </div>

            <div class="info">
              <div class=imagen-info>
              <img class="img-blog-pnoticias" src="{{url('assets_front/images/banner.jpg')}}" alt="">

              </div>
              <div class="contenido">
                <p class="parrafo-noticias">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum quam incidunt deserunt soluta? Tempora, porro explicabo quibusdam officiis animi quaerat deserunt aspernatur? Dicta quo quas voluptas atque, dolorum perspiciatis nesciunt. <br>
            
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat fuga sequi ducimus error magni laboriosam repellat provident nesciunt quaerat minima adipisci laborum ipsam nam at cumque ullam, dolorem voluptatum explicabo.
                </p>
                <p class="parrafo-noticias">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum quam incidunt deserunt soluta? Tempora, porro explicabo quibusdam officiis animi quaerat deserunt aspernatur? Dicta quo quas voluptas atque, dolorum perspiciatis nesciunt. <br>
               
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat fuga sequi ducimus error magni laboriosam repellat provident nesciunt quaerat minima adipisci laborum ipsam nam at cumque ullam, dolorem voluptatum explicabo.</p>
               
                
              </div>
            </div>
          </div>
          <div class="row interesar">
            <div class="col-md-12">
               <h4>Te puede interesar:</h4>
            </div>
            <div class="col-md-6">
              <div class="card-interesar">
                <div class="card-img">
                  <a href="#">
                   <img class="img-blog" src="{{url('assets_front/images/bascula-instalada-en-produpar.jpeg')}}" alt="">
                  </a>
                </div>
                <div class="card-cuerpo">
                <a href="#" class="link-blog"> 
                      Bascula Instalada en Produpar.
                      </a>
                      <p>Bascula Instalada en Produpar - Ciudad de Villeta.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card-interesar">
                  <div class="card-img">
                    <a href="#">
                      <img class="img-blog" src="{{url('assets_front/images/bascula-de-hormigon-con-vigas-laterales-2.jpg')}}" alt="">
                    </a>
                  </div>
                  <div class="card-cuerpo">
                  <a href="#" class="link-blog"> 
                      Bascula Entregada en la Constructora 8A Ciudad de Caaguazu.
                      </a>
                      <p>Bascula Entregada en la Constructora 8A en compañia del Ing. Recalde, residente de la Cantera.</p>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-3">
          <aside class="aside">
            <div class="aside-img">
              <img src="{{url('assets_front/images/asesoramiento.png')}}" alt="">
            </div>
            <div class="aside-info">
              <p class="title-aside" >Solicitar Asesoramiento</p>
              <p class="text-aside">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil tenetur dolor, libero temporibus doloribus quo perspiciatis itaque quaerat repellat sit minus atque consequuntur, nemo omnis modi, sint nesciunt vero iste?</p>
            </div>
            <div class="btn-asesoria">
              <a href="{{route('front.contacto')}}">Solicitar Asesoria</a>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
@endsection
