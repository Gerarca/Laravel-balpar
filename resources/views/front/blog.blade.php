@extends('layouts.front')
@section('title','Blog |')
@section('content')
    <section class="blog">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="row">
              <div class="col-md-12 content-blog">
                <h2 class="title-blog">Todas las publicaciones</h2>
              </div>
           </div>
           @foreach ($blogs as $blog)
             <div class="row container-card">
               <div class="col-md-12 col-lg-5">
                 <a href="{{$blog->fullURL()}}">
                   <img class="img-blog" src="{{$blog->imagen_url}}" alt="{{$blog->titulo}}">
                 </a>
               </div>
               <div class="col-md-12 col-lg-7">
                 <div class="row">
                   <div class="col-md-12">
                     <div class="contenido-card">
                       <div class="content-fecha">
                         <p class="etiqueta"></p>
                         {{-- <p class="etiqueta">#Básculas Para Camiones</p> --}}
                         <p class="fecha">{{$blog->fecha_format}} <span class="clock"><i class="far fa-clock"></i></span> </p>
                       </div>
                       <a href="{{$blog->fullURL()}}" class="link-blog">
                         {{$blog->titulo}}
                       </a>
                       <p>{!! $blog->resumen_contenido !!}</p>
                       <p class="autor"> Por: <span> {{$blog->user->name}} </span> </p>
                     </div>
                   </div>
                 </div>

               </div>
             </div>
           @endforeach
           @if (count($blogs) < 1)
             <div class="row" style="margin-top: 45px;">
               <div class="col-md-12">
                 <h3 class="text-center">Sin resultados</h3>
               </div>
             </div>
           @endif
            {{-- <div class="row">
              <div class="col-md-12 text-center mt-5">
                <a class="btn-publicaciones" href="{{route('front.blog')}}">Ver más publicaciones</a>
              </div>
            </div> --}}
            <nav class="toolbox toolbox-pagination" id="pages">
              {{ $blogs->appends(request()->input())->links() }}
            </nav>
          </div>
          <div class="col-md-12 col-lg-4">
            <aside class="aside-buscador">
              <div class="contert-form">
                <form action="" class="form">
                  <input class="buscar" type="text" name="search" value="{{isset($search)?$search:null}}" placeholder="Buscar" autocomplete="off">
                <button type="submit" class="btn-form">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                </form>
              </div>
              <div class="widget">
                <p class="title-widget">Categorías</p>
                <ul class="categorias-widget">
                  @foreach ($categorias as $categoria)
                    <li><a href="{{route('front.blog').'?c='.$categoria->id}}" style="{{$categoria_id == $categoria->id ? 'color: #12488f; font-weight: 500':''}}">{{$categoria->categoria}}</a></li>
                  @endforeach
                  <li><a href="{{route('front.blog')}}">Ver todo</a></li>
                </ul>
              </div>

              {{-- <div class="etiquetas">
                <p class="title-widget">Etiquetas</p>
                <ul class="list-etiquetas">
                  <li><a href="">Góndolas y Almacenes</a></li>
                  <li><a href="">Pesaje Industrial</a></li>
                  <li><a href="">Basculas para camiones</a></li>
                </ul>
              </div> --}}

            </aside>
          </div>
        </div>
      </div>
    </section>
@endsection
