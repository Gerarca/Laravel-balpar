@extends('layouts.front')
@section('title','Nosotros |')
@section('content')

  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ url('assets_front/images/balpar_bannner.jpeg') }});">
    <h2 class="l-text2 t-center">
      Nosotros
    </h2>
  </section>


  <section class="bgwhite p-t-66 p-b-30">
    <div class="container">
      <div class="about-text row">

        @if($data->video)
            <div class="row">
                <div class="col-md-12">
                    <iframe width="770" height="315" src="https://www.youtube.com/embed/{{ $data->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        @endif

        <div class="col-md-12 p-b-30">
          <h3 class="m-text26 p-b-16">
            La Empresa
          </h3>
          <p>
            A mediados de 1991 se inicia la actividad de BALPAR S.A., fruto del acercamiento tecnológico y comercial de los fundadores de la empresa con los fabricantes europeos de balanzas DINA.
          </p>
          <p>Durante diez años se impulsa, conjuntamente con el fabricante europeo DINA, la implantación de las más vanguardistas y avanzadas tecnologías de pesaje en el mercado paraguayo. Con mucho éxito se constituye Balpar S.A. en la precursora de la instalación de redes de equipos de pesaje inteligentes en dicho mercado.</p>
          <p>Desde un inicio, la empresa enfatiza la vocación de servicio y la inclinación prioritaria por la calidad, desechando aquellas soluciones o productos que solamente contemplen el menor precio pero descuidando la calidad.</p>
          <p>A partir del año 2004, se disuelve la alianza entre Balpar y DINA, al crecer el interés de nuestra empresa en comercializar otras gamas de productos más allá de los producidos por el fabricante europeo. Se continúa la comercialización de los productos DINA pero se potencia la diversificación hacia otras líneas y gamas de productos que son demandados por nuestra selecta cartera de clientes. En forma progresiva pero constante, se van añadiendo nuevos productos: cajas registradoras y terminales punto de venta, equipos gastronómicos, cuchillería profesional, mobiliario comercial, carros  y canastos, accesorios de pesaje y consumibles para toda la gama ofertada.</p>
          <p>La cobertura no solamente crece en la amplitud de la gama sino que se extiende progresivamente hasta cubrir toda la geografía nacional, haciendo llegar nuestros productos y servicios hasta los lugares más remotos de nuestro país.</p>
          <p>Desde el año 2006 nuestra gama incluye una extensa gama de soluciones de mobiliario comercial e industrial, generando soluciones modernas y ajustadas a los desafios de cada cliente. Tambien en dicho año iniciamos nuestro liderazgo en la oferta de cuchillos profesionales para los mas grandes frigorificos y supermercados del país.</p>
          <p>La estrategia de diversificación racional y de crecimiento en la oferta de soluciones a los clientes existentes nos lleva a incorporar en el 2011 un nuevo desafío de gran futuro: la entrada al mundo de la higiene institucional.</p>
          <p>Desde mediados de dicho año se apoya a los sectores de la industria, el comercio y los servicios con nuestra oferta de accesorios, consumibles y equipos de limpieza e higiene institucional.</p>
          <p>Nuestra mas nueva apuesta por la diversificacion viene en el 2018, con la division de ITS ( Intelligent Traffic Systems), en la cual ofrecemos soluciones integrales de control inteligente vial y de trafico. En dicha gama se incluyen estaciones de control de peso dinamico en carreteras, control de velocidad, de configuracion de vehiculos, aforos, sistemas de peaje y otros.</p>
          <p>Creemos en la dinámica positiva y superior que muestra nuestro país en los últimos años, apostando por una continuidad de ese camino en los próximos años y queriendo brindar, desde nuestra empresa, aquellos servicios y soluciones que creemos pueden colaborar en el desarrollo de las empresas nacionales.</p>
        </div>

        <div class="col-md-12 p-b-30">
          <div class="hov-img-zoom">
            <img src="{{url('assets_front/images/nosotros2.jpg')}}">
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="shipping bgwhite p-b-46">
    <div class="flex-w p-l-15 p-r-15">
      <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1 box-info box-info1" style="background-image:url({{url('assets_front/images/flag.svg')}});">
        <h4 class="m-text12 t-center text-color">
          Misión
        </h4>
        <span class="s-text8">
          Brindar la mejor cooperación a nuestros clientes para ayudarles a potenciar y optimizar sus objetivos, contribuyendo así al desarrollo integral de nuestro país.
        </span>
      </div>

      <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2 box-info box-info1" style="background-image:url({{url('assets_front/images/vision.svg')}});">
        <h4 class="m-text12 t-center text-color">
          Visión
        </h4>
        <span class="s-text8">
          Lograr el reconocimiento de la sociedad y de nuestros clientes, como empresa que ofrece soluciones innovadoras y convenientes, basadas en la excelencia e integridad profesional de su equipo humano.
        </span>
      </div>

      <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1 box-info box-info1" style="background-image:url({{url('assets_front/images/doc.svg')}});">
        <h4 class="m-text12 t-center text-color">
          Valores y compromisos
        </h4>
        <span class="s-text8">
          <ul class="disc-list">
            <li>Potenciar el respeto y la dignidad de las personas en el ambiente de trabajo.</li>
            <li>Respetar la salud y la seguridad ocupacional, cuidando el estricto cumplimiento de las leyes.</li>
            <li>Promover la integridad, la honestidad y el desarrollo de nuestro equipo humano, como elementos fundamentales para el progreso colectivo.</li>
            <li>Impulsar el crecimiento personal y la mejora continua como prioridades en los objetivos de optimización de la calidad e innovación.</li>
            <li>Concientizar en la necesidad del cuidado del medio ambiente en todos los procesos del trabajo.</li>
          </ul>
        </span>
      </div>
    </div>
  </section>
@endsection

@section('especifico')
@endsection
