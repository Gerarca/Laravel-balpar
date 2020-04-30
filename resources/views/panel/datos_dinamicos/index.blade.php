@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Datos Dinamicos</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Años de Trayectoria</th>
                                    <th>Clientes Satisfechos</th>
                                    <th>Fuentes de Trabajo</th>
                                    <th>Ultima actualización</th>
                                    <th class="disabled-sorting text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Años de Trayectoria</th>
                                    <th>Clientes Satisfechos</th>
                                    <th>Fuentes de Trabajo</th>
                                    <th>Ultima actualización</th>
                                    <th class="disabled-sorting text-center">Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <th class="text-center">1</th>
                                    <td class="text-center">{{ $dato_dinamico->years }}</td>
                                    <td class="text-center">{{ $dato_dinamico->clientes }}</td>
                                    <td class="text-center">{{ $dato_dinamico->trabajos }}</td>
                                    <td class="text-center">{{ $dato_dinamico->updated_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('datos_dinamicos.edit', $dato_dinamico->id) }}" class="btn btn-warning btn-link btn-icon btn-sm edit" title="Editar"><i class="fa fa-edit"></i></a>
                                        {{-- <a href="#" class="btn btn-danger btn-link btn-icon btn-sm remove btn-delete" data-id="{{ $dato_dinamico->id }}" data-toggle="modal"  data-target="#modal-default" data-route="{{ route('mision-vision.destroy', $dato_dinamico->id) }}" data-title="{{ dato_dinamico->nombre }}"><i class="fa fa-times"></i></a> --}}
                                    </td>
                                </tr>
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
                    <h5 class="modal-title" id="ModalLabel">Eliminar usuario</h5>
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
        // $(document).on('click', '.btn-delete', function(){
        //     $('.modal form').attr('action', $(this).data('route'));
        //     $('#ModalLabel').text($(this).data('title'));
        // })
    </script>
@endsection
