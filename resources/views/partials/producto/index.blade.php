
   
<div class="product" >
  <figure class="product-image-container">
    <a href="{{ route('front.productos.ver',[$producto->cod_articulo,str_slug($producto->titulo)])}}" class="product-image">
      <img src="{{ url('storage/productos/'.$producto->imagen) }}" alt="{{$producto->titulo}}">
    </a>
  </figure>
  <div class="product-details">
    <h2 class="product-title">
      <a href="{{ route('front.productos.ver',[$producto->cod_articulo,str_slug($producto->titulo)])}}">{{$producto->titulo}}</a>
    </h2>
    <div class="price-box">
      <span class="product-price">{{$producto->precio()}}</span>
      <span class="product-price cuotas">12 cuotas desde Gs. 50.000</span>
    </div>
    <div class="product-action">
      <a href="javascript:void(0)" class="paction add-cart" data-prod="{{$producto->cod_articulo}}">
        <span>Comprar</span>
      </a>
    </div>
  </div>
</div>
