@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Administrar Lineas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Lista de sus lineas registradas</div>
                </div>
                <div class="panel-body">
                    <table style="width:100%;" class="table table-striped table-bordered table-hover display responsive no-wrap" id="lines-table">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Expira</th>
                                @role('admin')
                                <th>Vendedor</th>
                                @endrole
                                <th>Notas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lines as $line)
                                <tr>
                                    <td>{!!$line->status!!}</td>
                                    <td>{{$line->username}}</td>
                                    <td>{{$line->password}}</td>
                                    <td>{!!$line->expire!!}</td>
                                    @role('admin')
                                    @if(!$line->user()->get()->isEmpty())
                                    <td>{{$line->user()->first()->username}}</td>
                                    @else
                                    <td>Ninguno</td>
                                    @endif
                                    @endrole
                                    <td>{{$line->reseller_notes}}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{route('line.edit', ['id'=>$line->id])}}">
                                                <button type="button" class="btn btn-warning btn-circle"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Editar Linea"></i></button>
                                            </a>
                                            @role('admin')
                                                <button type="button" onclick="lineDelete({{$line->id}})" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Eliminar Linea"><i class="fa fa-trash"></i></button>
                                                @endrole
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(function() {
            $('#lines-table').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                responsive: true
            });
        });
        function lineDelete(id)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Estas seguro?',
                text: "Esta accion no se puede deshacer!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#428bca',
                cancelButtonColor: '#d9534f',
                confirmButtonText: 'Si, Borralo!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: +id+"/delete",
                            type: 'DELETE',
                            data: {_token: CSRF_TOKEN},
                            dataType: 'JSON',
                            success: function(result) {
                                if(result['code'!=204])
                                {
                                    swal(
                                    'Error!',
                                    result['message'],
                                    'error'
                                    );
                                }else {
                                    swal(
                                    'Hecho!',
                                    result['message'],
                                    'success'
                                    ).then((result) => {
                                        window.location.href = "{{route('line.manage')}}";
                                    });
                                }
                            },
                            error: function(rest){
                                swal(
                                    'Error!',
                                    'No se pudo completar la peticion',
                                    'error'
                                    );
                            }
                        });
                    }
                });
        }
    </script>
@endpush