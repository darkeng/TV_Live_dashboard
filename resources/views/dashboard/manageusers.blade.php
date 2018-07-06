@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Administrar Usuarios</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Lista de todos los usuarios registrados</div>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                {{ session('error') }}
                        </div>
                    @endif
                    <table style="width:100%;" class="table table-striped table-bordered table-hover display responsive no-wrap" id="users-table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Contraseña [TEMP]</th>
                                <th>Correo</th>
                                <th>Registrado el</th>
                                <th>Actualizado el</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if($user != Auth::user())
                                    <tr>
                                        <td>{{$user->username}}
                                            @if($user->hasRole('admin')) <span class="label label-danger">Admin</span>
                                            @endif
                                            @if($user->hasRole('user')) <span class="label label-default">Vendedor</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->activated)<span class="label label-success">Activada <i class="fa fa-check"></i></span>
                                            @else {{$user->temp_password}} <span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(($user->email!="") || ($user->email!=null)){{$user->email}}
                                                @if($user->confirmed) <span class="text-success"> <i class="fa fa-check"></i></span>
                                                @else <span class="text-danger"> <i class="fa fa-times"></i></span>
                                                @endif
                                            @else
                                                <span>No establecido</span>
                                            @endif
                                        </td>
                                        <td>{{$user->created_at->format('d F Y h:i A')}}</td>
                                        <td>{{$user->updated_at->format('d F Y h:i A')}}</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="{{route('user.show', ['id'=>$user->id])}}">
                                                    <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="left" title="Ver Perfil"><i class="fa fa-user"></i></button>
                                                </a>
                                                <button type="button" onclick="userResetP({{$user->id}})" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Restablecer Contraseña"><i class="fa fa-key"></i></button>
                                                <button type="button" onclick="userDelete({{$user->id}})" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Eliminar Usuario"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
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
            $('#users-table').DataTable({
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
        function userDelete(id)
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
                        url: "/dashboard/user/"+id,
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
                                    window.location.href = "{{route('user.index')}}";
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
        function userResetP(id)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            swal({
            title: 'Estas seguro?',
            text: "Esta accion no se puede deshacer!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#428bca',
            cancelButtonColor: '#d9534f',
            confirmButtonText: 'Si, Resetear!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/dashboard/user/"+id+"/resetpass",
                        type: 'PUT',
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
                                    window.location.reload();
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