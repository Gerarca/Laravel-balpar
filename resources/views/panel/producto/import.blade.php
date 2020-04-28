@extends('layouts.panel')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12 col-sm-6 offset-sm-3">
                <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Añadir Archivo</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group has-label">
                                <label for="image">Archivo *</label>
                                <div class="custom-file">
                                    <input type="file" style="opacity:1" class=" @error('file') is-invalid @enderror" 
                                           name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >

                                </div>
                            </div>
                            <div class="category form-category">* Campos requeridos</div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary" id="btn-submit-transaction">Cargar Archivo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('especifico')
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $.notify({
                    message: '{{ $error }}',
                }, {
                    type: 'danger',
                    delay: 0,
                });
            </script>
        @endforeach
    @endif
@endsection
