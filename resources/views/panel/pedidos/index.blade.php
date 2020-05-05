@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pedidos</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th class="disabled-sorting text-right">Detalles</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th class="disabled-sorting text-right">Detalles</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($pedidos as $pedido)
                                    <tr>
                                        <td class="text-center" data-sort="{{$pedido->id}}">Ped-{{ $pedido->id }}</td>
                                        <td>{{ $pedido->nombre }}</td>
                                        <td>{{ $pedido->email }}</td>
                                        <td>
                                            @if($pedido->estado == 1)
                                                <button type="button" class="btn btn-sm btn-danger">Pendiente</button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-success">Realizado</button>
                                            @endif
                                        </td>
                                        <td>{{ $pedido->created_at }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-link btn-icon btn-sm edit "><i class="fa fa-eye"></i></a>
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

  </script>
@endsection
