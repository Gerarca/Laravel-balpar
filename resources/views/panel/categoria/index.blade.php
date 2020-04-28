@extends('layouts.panel')

@section('content')
  <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Categorias</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Titulo</th>
                      <th>Padre</th>
                      <th>Imagen</th>
                      <th>Fecha de creación</th>
                      <th>Prioridad</th>

                      <th class="disabled-sorting text-right">Acciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Titulo</th>
                      <th>Padre</th>
                      <th>Imagen</th>
                      <th>Fecha de creación</th>
                      <th>Prioridad</th>
                      <th class="disabled-sorting text-right">Acciones</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach($categorias as $categoria)
                        <tr>
                          <td>{{ $categoria->titulo }}</td>
                          <td>{{ count($categoria->getPadre($categoria->cod_padre))?$categoria->getPadre($categoria->cod_padre)[0]->titulo:'-' }}</td>
                          <td>
                            @if (strlen($categoria->imagen)>=1)
                              <img src="{{ url('uploads/'.$categoria->imagen) }}" alt="{{ $categoria->titulo }}" width="100"></td>
                            @endif
                          <td>{{ $categoria->created_at }}</td>
                          <td>{{ $categoria->orden }}</td>
                          <td class="text-right">
                              <a href="{{ route('categoria.edit', $categoria->id) }}" class="btn btn-warning btn-link btn-icon btn-sm edit "><i class="fa fa-edit"></i></a>
                              <a href="#" class="btn btn-danger btn-link btn-icon btn-sm remove btn-delete" data-id="{{ $categoria->id }}" data-toggle="modal"  data-target="#modal-default" data-route="{{ route('categoria.destroy', $categoria->id) }}" data-title="{{ $categoria->name }}"><i class="fa fa-times"></i></a>

                          </td>
                        </tr>
                      @endforeach


                  </tbody>
                </table>
              </div>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
      </div>
@endsection


@section('especifico')

  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Eliminar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Esta acción es irreversible, está seguro que desa continuar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cancelar</button>
        <form class="" action="" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger" name="button">Sí, eliminar</button>
        </form>

      </div>
    </div>
  </div>
</div>


  <script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "Todos"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Buscar registros",
        }

      });

      var table = $('#datatable').DataTable();

      @if($errors->any())
        @foreach ($errors->all() as $error)
        $.notify({
        	// options
        	message: '{{$error}}'
        },{
        	// settings
        	type: 'danger'
        });
        @endforeach
      @endif
      @if(session()->has('mensaje'))
      $.notify({
        // options
        message: '{{ session()->get('mensaje') }}'
      },{
        // settings
        type: 'success'
      });

      @endif


    });
    $(document).on('click', '.btn-delete', function(){
      $('.modal form').attr('action', $(this).data('route'));
      $('#ModalLabel').text($(this).data('title'));
    })
  </script>
@endsection
