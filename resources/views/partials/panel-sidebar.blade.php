<ul class="nav">
  <li class="{{ Request::is('panel')?'active':''}}">
    <a href="{{ route('panel.index') }}">
      <i class="nc-icon nc-layout-11"></i>
      <p>Inicio</p>
    </a>
  </li>

  <li class="{{ (Request::is('panel/pedidos/*') || Request::is('panel/pedidos'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_pedidos" class="{{ (Request::is('panel/pedidos/*') || Request::is('panel/pedidos'))?'collapsed':''}}">
      <i class="nc-icon nc-cart-simple"></i>
      <p>
        Pedidos
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/pedidos/*') || Request::is('panel/pedidos') || Request::is('panel/solicitudes/*') || Request::is('panel/solicitudes') || Request::is('panel/solicitudesPendientes/*') || Request::is('panel/solicitudesPendientes'))?'collapse show':'collapse'}} " id="menu_pedidos">
      <ul class="nav">
        <li class="{{ (Request::is('panel/pedidos') || Request::is('panel/pedidos/*/edit'))?'active':''}} ">
          <a href="{{ route('pedidos.index') }}">
            <span class="sidebar-mini-icon">LP</span>
            <span class="sidebar-normal"> Lista de pedidos </span>
          </a>
        </li>
        {{-- <li class="">
          <a href="{{ route('pedidos.export') }}">
            <span class="sidebar-mini-icon">EP</span>
            <span class="sidebar-normal"> Exportar pedidos </span>
          </a>
        </li> --}}

        {{-- <li class="{{ (Request::is('panel/solicitudes') || Request::is('panel/solicitudes/*/edit'))?'active':''}} ">
          <a href="{{ route('solicitudes.index') }}">
            <span class="sidebar-mini-icon">LS</span>
            <span class="sidebar-normal"> Lista de solicitudes </span>
          </a>
        </li> --}}
        {{-- <li class="{{ (Request::is('panel/solicitudesPendientes') || Request::is('panel/solicitudesPendientes/*/edit'))?'active':''}} ">
          <a href="{{ route('solicitudesPendientes.index') }}">
            <span class="sidebar-mini-icon">LSP</span>
            <span class="sidebar-normal"> Lista de solicitudes pen </span>
          </a>
        </li> --}}

      </ul>
    </div>
  </li>
  <li class="{{ (Request::is('panel/banner/*') || Request::is('panel/banner'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_banner" class="{{ (Request::is('panel/banner/*') || Request::is('panel/banner'))?'collapsed':''}}">
      <i class="nc-icon nc-image"></i>
      <p>
        Banners
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/banner/*') || Request::is('panel/banner'))?'collapse show':'collapse'}} " id="menu_banner">
      <ul class="nav">
        <li class="{{ (Request::is('panel/banner') || Request::is('panel/banner/*/edit'))?'active':''}} ">
          <a href="{{ route('banner.index') }}">
            <span class="sidebar-mini-icon">LB</span>
            <span class="sidebar-normal"> Lista de banners </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/banner/create'))?'active':''}} ">
          <a href="{{ route('banner.create') }}">
            <span class="sidebar-mini-icon">AB</span>
            <span class="sidebar-normal"> Añadir Banner </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="{{ (Request::is('panel/blog/*') || Request::is('panel/blog'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_blog" class="{{ (Request::is('panel/blog/*') || Request::is('panel/blog'))?'collapsed':''}}">
      <i class="nc-icon nc-image"></i>
      <p>
        Blogs
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/blog/*') || Request::is('panel/blog'))?'collapse show':'collapse'}} " id="menu_blog">
      <ul class="nav">
        <li class="{{ (Request::is('panel/blog') || Request::is('panel/blog/*/edit'))?'active':''}} ">
          <a href="{{ route('blog.index') }}">
            <span class="sidebar-mini-icon">LB</span>
            <span class="sidebar-normal"> Lista de Blogs </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/blog/create'))?'active':''}} ">
          <a href="{{ route('blog.create') }}">
            <span class="sidebar-mini-icon">AB</span>
            <span class="sidebar-normal"> Añadir Blog </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="{{ (Request::is('panel/serviciovideos/*') || Request::is('panel/serviciovideos'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_serviciovideos" class="{{ (Request::is('panel/serviciovideos/*') || Request::is('panel/serviciovideos'))?'collapsed':''}}">
      <i class="nc-icon nc-album-2"></i>
      <p>
        ST Recursos
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/serviciovideos/*') || Request::is('panel/serviciovideos'))?'collapse show':'collapse'}} " id="menu_serviciovideos">
      <ul class="nav">
        <li class="{{ (Request::is('panel/serviciovideos') || Request::is('panel/serviciovideos/*/edit'))?'active':''}} ">
          <a href="{{ route('serviciovideos.index') }}">
            <span class="sidebar-mini-icon">LB</span>
            <span class="sidebar-normal"> Lista de ST Recursos </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/serviciovideos/create'))?'active':''}} ">
          <a href="{{ route('serviciovideos.create') }}">
            <span class="sidebar-mini-icon">AB</span>
            <span class="sidebar-normal"> Añadir ST Recurso </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="{{ (Request::is('panel/producto/*') || Request::is('panel/producto'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_producto" class="{{ (Request::is('panel/producto/*') || Request::is('panel/producto'))?'collapsed':''}}">
      <i class="nc-icon nc-bag-16"></i>
      <p>
        Productos
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/producto/*') || Request::is('panel/producto'))?'collapse show':'collapse'}} " id="menu_producto">
      <ul class="nav">
        <li class="{{ (Request::is('panel/producto') || Request::is('panel/producto/*/edit'))?'active':''}} ">
          <a href="{{ route('producto.index') }}">
            <span class="sidebar-mini-icon">LP</span>
            <span class="sidebar-normal"> Lista de productos </span>
          </a>
        </li>
		<li class="{{ (Request::is('panel/producto/create'))?'active':''}} ">
          <a href="{{ route('producto.create') }}">
            <span class="sidebar-mini-icon">CP</span>
            <span class="sidebar-normal"> Crear Producto </span>
          </a>
        </li>
      </ul>
    </div>
  </li>

  <li class="{{ (Request::is('panel/categorias/*') || Request::is('panel/categorias') || Request::is('panel/etiquetas/*') || Request::is('panel/etiquetas') || Request::is('panel/usos/*') || Request::is('panel/usos') || Request::is('panel/rubros/*') || Request::is('panel/rubros'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_categoria" class="{{ (Request::is('panel/categorias/*') || Request::is('panel/categorias') || Request::is('panel/etiquetas/*') || Request::is('panel/etiquetas') || Request::is('panel/usos/*') || Request::is('panel/usos') || Request::is('panel/rubros/*') || Request::is('panel/rubros'))?'collapsed':''}}">
      <i class="fa fa-tags"></i>
      <p>
        Categorias
        <b class="caret"></b>
      </p>
    </a>

    <div class="{{ (Request::is('panel/categorias/*') || Request::is('panel/categorias') || Request::is('panel/etiquetas/*') || Request::is('panel/etiquetas') || Request::is('panel/usos/*') || Request::is('panel/usos') || Request::is('panel/rubros/*') || Request::is('panel/rubros'))?'collapse show':'collapse'}} " id="menu_categoria">
      <ul class="nav">
        <li class="{{ (Request::is('panel/categorias') || Request::is('panel/categorias/*/edit'))?'active':''}} ">
          <a href="{{ route('categorias.index') }}">
            <span class="sidebar-mini-icon">LC</span>
            <span class="sidebar-normal"> Lista de categorias </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/categorias/create'))?'active':''}} ">
          <a href="{{ route('categorias.create') }}">
            <span class="sidebar-mini-icon">AC</span>
            <span class="sidebar-normal"> Añadir Categoria </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/rubros') || Request::is('panel/rubros/*/edit'))?'active':''}} ">
          <a href="{{ route('rubros.index') }}">
            <span class="sidebar-mini-icon">LR</span>
            <span class="sidebar-normal"> Lista de Rubros </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/rubros/create'))?'active':''}} ">
          <a href="{{ route('rubros.create') }}">
            <span class="sidebar-mini-icon">AR</span>
            <span class="sidebar-normal"> Añadir Rubros </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/usos') || Request::is('panel/usos/*/edit'))?'active':''}} ">
          <a href="{{ route('usos.index') }}">
            <span class="sidebar-mini-icon">LU</span>
            <span class="sidebar-normal"> Lista de Usos </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/usos/create'))?'active':''}} ">
          <a href="{{ route('usos.create') }}">
            <span class="sidebar-mini-icon">AU</span>
            <span class="sidebar-normal"> Añadir Usos </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/etiquetas') || Request::is('panel/etiquetas/*/edit'))?'active':''}} ">
          <a href="{{ route('etiquetas.index') }}">
            <span class="sidebar-mini-icon">LE</span>
            <span class="sidebar-normal"> Lista de Etiquetas </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/etiquetas/create'))?'active':''}} ">
          <a href="{{ route('etiquetas.create') }}">
            <span class="sidebar-mini-icon">AE</span>
            <span class="sidebar-normal"> Añadir Etiquetas </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="{{ (Request::is('panel/marcas/*') || Request::is('panel/marcas'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_marca" class="{{ (Request::is('panel/marcas/*') || Request::is('panel/marcas'))?'collapsed':''}}">
      <i class="nc-icon nc-tag-content"></i>
      <p>
        Marcas
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/marcas/*') || Request::is('panel/marcas'))?'collapse show':'collapse'}} " id="menu_marca">
      <ul class="nav">
        <li class="{{ (Request::is('panel/marcas') || Request::is('panel/marcas/*/edit'))?'active':''}} ">
          <a href="{{ route('marcas.index') }}">
            <span class="sidebar-mini-icon">LM</span>
            <span class="sidebar-normal"> Lista de Marcas </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/marcas/create'))?'active':''}} ">
          <a href="{{ route('marcas.create') }}">
            <span class="sidebar-mini-icon">AM</span>
            <span class="sidebar-normal"> Añadir Marca </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  {{-- <li class="{{ (Request::is('panel/sucursal/*') || Request::is('panel/sucursal'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_sucursal" class="{{ (Request::is('panel/sucursal/*') || Request::is('panel/sucursal'))?'collapsed':''}}">
      <i class="nc-icon nc-bank"></i>
      <p>
        Sucursales
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/sucursal/*') || Request::is('panel/sucursal'))?'collapse show':'collapse'}} " id="menu_sucursal">
      <ul class="nav">
        <li class="{{ (Request::is('panel/sucursal') || Request::is('panel/sucursal/*/edit'))?'active':''}} ">
          <a href="{{ route('sucursal.index') }}">
            <span class="sidebar-mini-icon">LM</span>
            <span class="sidebar-normal"> Lista de Sucursales </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/sucursal/create'))?'active':''}} ">
          <a href="{{ route('sucursal.create') }}">
            <span class="sidebar-mini-icon">AM</span>
            <span class="sidebar-normal"> Añadir Sucursal </span>
          </a>
        </li>
      </ul>
    </div>
  </li> --}}
  {{-- <li class="{{ (Request::is('panel/ciudad/*') || Request::is('panel/ciudad'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_ciudad" class="{{ (Request::is('panel/ciudad/*') || Request::is('panel/ciudad'))?'collapsed':''}}">
      <i class="nc-icon nc-istanbul"></i>
      <p>
        Ciudades
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/ciudad/*') || Request::is('panel/ciudad'))?'collapse show':'collapse'}} " id="menu_ciudad">
      <ul class="nav">
        <li class="{{ (Request::is('panel/ciudad') || Request::is('panel/ciudad/*/edit'))?'active':''}} ">
          <a href="{{ route('ciudad.index') }}">
            <span class="sidebar-mini-icon">LC</span>
            <span class="sidebar-normal"> Lista de ciudades </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/ciudad/create'))?'active':''}} ">
          <a href="{{ route('ciudad.create') }}">
            <span class="sidebar-mini-icon">AC</span>
            <span class="sidebar-normal"> Añadir Ciudad </span>
          </a>
        </li>
      </ul>
    </div>
  </li> --}}
  {{-- <li class="{{ (Request::is('panel/solicitudtarjeta/*') || Request::is('panel/solicitudtarjeta'))?'active':''}}">
    <a data-toggle="" href="{{ route('solicitudtarjeta.index') }}" class="{{ (Request::is('panel/solicitudtarjeta/*') || Request::is('panel/solicitudtarjeta'))?'collapsed':''}}">
      <i class="nc-icon nc-credit-card"></i>
      <p>
        Solicitudes de tarjeta
      </p>
    </a>

  </li> --}}
  {{-- <li class="{{ (Request::is('panel/newsletter/*') || Request::is('panel/newsletter'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_newsletter" class="{{ (Request::is('panel/newsletter/*') || Request::is('panel/newsletter'))?'collapsed':''}}">
      <i class="nc-icon nc-paper"></i>
      <p>
        Newsletters
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/newsletter/*') || Request::is('panel/newsletter'))?'collapse show':'collapse'}} " id="menu_newsletter">
      <ul class="nav">
        <li class="{{ (Request::is('panel/newsletter') || Request::is('panel/newsletter/*/edit'))?'active':''}} ">
          <a href="{{ route('newsletter.index') }}">
            <span class="sidebar-mini-icon">LN</span>
            <span class="sidebar-normal"> Lista de newsletters </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/newsletter/create'))?'active':''}} ">
          <a href="{{ route('newsletter.create') }}">
            <span class="sidebar-mini-icon">EN</span>
            <span class="sidebar-normal"> Exportar Newsletters </span>
          </a>
        </li>

      </ul>
    </div>
  </li> --}}


  {{-- <li class="{{ (Request::is('panel/reportes/*') || Request::is('panel/reportes'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_reportes" class="{{ (Request::is('panel/reportes/*') || Request::is('panel/reportes'))?'collapsed':''}}">
      <i class="nc-icon nc-chart-bar-32"></i>
      <p>
        Reportes
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/reportes/*') || Request::is('panel/reportes'))?'collapse show':'collapse'}} " id="menu_reportes">
      <ul class="nav">
        <li class="{{ ( Request::is('panel/reportes/ventas'))?'active':''}} ">
          <a href="{{ route('reportes.venta') }}">
            <span class="sidebar-mini-icon">RV</span>
            <span class="sidebar-normal"> Reporte por Ventas </span>
          </a>
        </li>
        <li class="{{ ( Request::is('panel/reportes/solicitudes'))?'active':''}} ">
          <a href="{{ route('reportes.solicitud') }}">
            <span class="sidebar-mini-icon">RS</span>
            <span class="sidebar-normal"> Reporte por Solicitudes </span>
          </a>
        </li>
        <li class="{{ ( Request::is('panel/reportes/usuarios'))?'active':''}} ">
          <a href="{{ route('reportes.usuario') }}">
            <span class="sidebar-mini-icon">RU</span>
            <span class="sidebar-normal"> Reporte por Usuarios </span>
          </a>
        </li>
        <li class="{{ ( Request::is('panel/reportes/productos'))?'active':''}} ">
          <a href="{{ route('reportes.producto') }}">
            <span class="sidebar-mini-icon">RP</span>
            <span class="sidebar-normal"> Reporte por Productos </span>
          </a>
        </li>
        <li class="{{ ( Request::is('panel/reportes/marcas'))?'active':''}} ">
          <a href="{{ route('reportes.marca') }}">
            <span class="sidebar-mini-icon">RP</span>
            <span class="sidebar-normal"> Reporte por marcas </span>
          </a>
        </li>


      </ul>
    </div>
  </li> --}}
  <li class="{{ (Request::is('panel/users/*') || Request::is('panel/users'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_usuarios" class="{{ (Request::is('panel/users/*') || Request::is('panel/users'))?'collapsed':''}}">
      <i class="nc-icon nc-circle-10"></i>
      <p>
        Usuarios
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/users/*') || Request::is('panel/users'))?'collapse show':'collapse'}} " id="menu_usuarios">
      <ul class="nav">
        <li class="{{ (Request::is('panel/users') || Request::is('panel/users/*/edit'))?'active':''}} ">
          <a href="{{ route('users.index') }}">
            <span class="sidebar-mini-icon">LU</span>
            <span class="sidebar-normal"> Lista de usuarios </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/users/create'))?'active':''}} ">
          <a href="{{ route('users.create') }}">
            <span class="sidebar-mini-icon">AU</span>
            <span class="sidebar-normal"> Añadir usuario </span>
          </a>
        </li>

      </ul>
    </div>
  </li>
  {{-- <li class="{{ (Request::is('panel/clientes/*') || Request::is('panel/clientes'))?'active':''}}">
    <a data-toggle="collapse" href="#menu_clientes" class="{{ (Request::is('panel/clientes/*') || Request::is('panel/clientes'))?'collapsed':''}}">
      <i class="nc-icon nc-circle-10"></i>
      <p>
        Clientes
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/clientes/*') || Request::is('panel/clientes'))?'collapse show':'collapse'}} " id="menu_clientes">
      <ul class="nav">
        <li class="{{ (Request::is('panel/clientes') || Request::is('panel/clientes/*/edit'))?'active':''}} ">
          <a href="{{ route('clientes.index') }}">
            <span class="sidebar-mini-icon">LU</span>
            <span class="sidebar-normal"> Lista de clientes </span>
          </a>
        </li>

      </ul>
    </div>
  </li> --}}

  <li class="{{ (Request::is('panel/trabajos/*') || Request::is('panel/trabajos') || Request::is('panel/categoria_trabajos/*') || Request::is('panel/categoria_trabajos') )?'active':''}}">
    <a data-toggle="collapse" href="#menu_trabajo" class="{{ (Request::is('panel/trabajos/*') || Request::is('panel/trabajos') || Request::is('panel/categoria_trabajos/*') || Request::is('panel/categoria_trabajos') )?'collapsed':''}}">
      <i class="fa fa-gears"></i>
      <p>
        Trabajos
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/trabajos/*') || Request::is('panel/trabajos') || Request::is('panel/categoria_trabajos/*') || Request::is('panel/categoria_trabajos') )?'collapse show':'collapse'}} " id="menu_trabajo">
      <ul class="nav">
          <li class="{{ (Request::is('panel/categoria_trabajos') || Request::is('panel/categoria_trabajos/*/edit'))?'active':''}} ">
            <a href="{{ route('categoria_trabajos.index') }}">
              <span class="sidebar-mini-icon">LC</span>
              <span class="sidebar-normal"> Lista de Categorías </span>
            </a>
          </li>
          <li class="{{ (Request::is('panel/categoria_trabajos/create'))?'active':''}} ">
            <a href="{{ route('categoria_trabajos.create') }}">
              <span class="sidebar-mini-icon">AC</span>
              <span class="sidebar-normal"> Añadir Categorías </span>
            </a>
          </li>
        <li class="{{ (Request::is('panel/trabajos') || Request::is('panel/trabajos/*/edit'))?'active':''}} ">
          <a href="{{ route('trabajos.index') }}">
            <span class="sidebar-mini-icon">LT</span>
            <span class="sidebar-normal"> Lista de Trabajos </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/trabajos/create'))?'active':''}} ">
          <a href="{{ route('trabajos.create') }}">
            <span class="sidebar-mini-icon">AT</span>
            <span class="sidebar-normal"> Añadir Trabajos </span>
          </a>
        </li>
      </ul>
    </div>
  </li>

  <li class="{{ (Request::is('panel/catalogos/*') || Request::is('panel/catalogos') || Request::is('panel/categoria_catalogos/*') || Request::is('panel/categoria_catalogos')  )?'active':''}}">
    <a data-toggle="collapse" href="#menu_catalogo" class="{{ (Request::is('panel/catalogos/*') || Request::is('panel/catalogos') || Request::is('panel/categoria_catalogos/*') || Request::is('panel/categoria_catalogos') )?'collapsed':''}}">
      <i class="fa fa-folder-open-o"></i>
      <p>
        Catálogos
        <b class="caret"></b>
      </p>
    </a>
    <div class="{{ (Request::is('panel/catalogos/*') || Request::is('panel/catalogos') || Request::is('panel/categoria_catalogos/*') || Request::is('panel/categoria_catalogos') )?'collapse show':'collapse'}} " id="menu_catalogo">
      <ul class="nav">
        <li class="{{ (Request::is('panel/categoria_catalogos') || Request::is('panel/categoria_catalogos/*/edit'))?'active':''}} ">
          <a href="{{ route('categoria_catalogos.index') }}">
            <span class="sidebar-mini-icon">LC</span>
            <span class="sidebar-normal"> Lista de Categorías </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/categoria_catalogos/create'))?'active':''}} ">
          <a href="{{ route('categoria_catalogos.create') }}">
            <span class="sidebar-mini-icon">AC</span>
            <span class="sidebar-normal"> Añadir Categorías </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/catalogos') || Request::is('panel/catalogos/*/edit'))?'active':''}} ">
          <a href="{{ route('catalogos.index') }}">
            <span class="sidebar-mini-icon">LC</span>
            <span class="sidebar-normal"> Lista de Catálogos </span>
          </a>
        </li>
        <li class="{{ (Request::is('panel/catalogos/create'))?'active':''}} ">
          <a href="{{ route('catalogos.create') }}">
            <span class="sidebar-mini-icon">AC</span>
            <span class="sidebar-normal"> Añadir Catálogos </span>
          </a>
        </li>
      </ul>
    </div>
  </li>

  <li class="{{ (Request::is('panel/datos_dinamicos') || Request::is('panel/datos_dinamicos/*') || Request::is('panel/testimonios') || Request::is('panel/testimonios/*') || Request::is('panel/data/nosotros') || Request::is('panel/data/nosotros/update') )?'active':''}}">
        <a data-toggle="collapse" href="#menu_extra" class="{{ (Request::is('panel/datos_dinamicos') || Request::is('panel/datos_dinamicos/*') || Request::is('panel/testimonios') || Request::is('panel/testimonios/*') || Request::is('panel/data/nosotros') || Request::is('panel/data/nosotros/update') )?'collapsed':''}}">
            <i class="fa fa-commenting-o"></i>
            <p>
                Extra
                <b class="caret"></b>
            </p>
        </a>
        <div class="{{ (Request::is('panel/datos_dinamicos') || Request::is('panel/datos_dinamicos/*') || Request::is('panel/testimonios') || Request::is('panel/testimonios/*') || Request::is('panel/data/nosotros') || Request::is('panel/data/nosotros/update') )?'collapse show':'collapse'}} " id="menu_extra">
            <ul class="nav">
                <li class="{{ (Request::is('panel/datos_dinamicos') || Request::is('panel/datos_dinamicos/*/edit'))?'active':''}} ">
                    <a href="{{ route('datos_dinamicos.index') }}">
                        <span class="sidebar-mini-icon">DD</span>
                        <span class="sidebar-normal"> Datos Dinamicos </span>
                    </a>
                </li>
                <li class="{{ (Request::is('panel/testimonios') || Request::is('panel/testimonios/*/edit'))?'active':''}} ">
                    <a href="{{ route('testimonios.index') }}">
                        <span class="sidebar-mini-icon">LT</span>
                        <span class="sidebar-normal"> Lista de Testimonios </span>
                    </a>
                </li>
                <li class="{{ (Request::is('panel/data/nosotros') || Request::is('panel/data/nosotros/update'))?'active':''}} ">
                    <a href="{{ route('nosotros.edit') }}">
                        <span class="sidebar-mini-icon">VN</span>
                        <span class="sidebar-normal"> Video en Nosotros </span>
                    </a>
                </li>
            </ul>
        </div>
    </li>


</ul>
