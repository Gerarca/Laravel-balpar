
  @if ($categoria_list->id <> $categoria->id || $categoria_aux=='false')
    @if ($categoria_aux=='true')
      <a class="dropdown-item" data-value="{{$categoria_list->id}}" data-level="{{$categoria_list->jerarquia()}}" {{ $categoria_list->id==$categoria->cod_padre ?'data-default-selected=""':''}}  href="#">{{$categoria_list->jerarquia()}}_ {{$categoria_list->titulo}}</a>
      @else
        <a class="dropdown-item" data-value="{{$categoria_list->id}}" data-level="{{$categoria_list->jerarquia()}}" {{ $categoria_list->id==$categoria->id ?'data-default-selected=""':''}}  href="#">{{$categoria_list->jerarquia()}}_ {{$categoria_list->titulo}}</a>
    @endif
    @if (count($categoria_list['hijos']) > 0)
      @foreach($categoria_list['hijos'] as $categoria_list)
        @include('partials.categoria', ['categoria_list'=>$categoria_list, 'categoria_aux'=>$categoria_aux])
      @endforeach
    @endif
  @endif
