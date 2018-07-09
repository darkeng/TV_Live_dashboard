@extends('layouts.app')

@section('content')
@php
    $f_name = ($user->first_name!=null) || ($user->first_name!="");
    $l_name = ($user->last_name!=null) || ($user->last_name!="");
    $chk_email = ($user->email!=null) || ($user->email!="");
    $difusers = Auth::user()->id == $user->id;
@endphp
    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Informacion de Cuenta</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Datos de la cuenta
                </div>
                <div class="panel-body" style="padding-bottom:200px;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                            <div class="col-sm-6 col-md-4">
                                <div class="text-center">
                                    <img class="profile-img" src="{{$user->avatar}}" alt="{{$user->username}}">
                                    <p>
                                         <strong>{{$user->username}}</strong>
                                    </p>
                                    <p>
                                        @if($difusers)
                                        <button class="btn btn-info" role="button" disabled>Cambiar Imagen</button>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <form id="formEmail" class="" style="margin-top:20px;" action="" role="form">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <p class="form-control-static">
                                            @if($f_name)
                                                {{$user->first_name}}
                                            @else
                                                No se ha establecido.
                                                @if($difusers)
                                                <button type="button" class="btn btn-tooltip btn-default"  data-toggle="modal" data-target="#send-names-modal">
                                                    <a data-toggle="tooltip" data-placement="right" title="Editar nombre"><i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                </button>
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <p class="form-control-static">
                                            @if($l_name)
                                                {{$user->last_name}}
                                            @else
                                                No se ha establecido.
                                                @if($difusers)
                                                <button type="button" class="btn btn-tooltip btn-default"  data-toggle="modal" data-target="#send-names-modal">
                                                    <a data-toggle="tooltip" data-placement="right" title="Editar apellido"><i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                </button>
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Correo electronico
                                            @if($chk_email)
                                                @if($user->confirmed)
                                                    <span class="label label-success">Verificado <i class="fa fa-check"></i> </span>
                                                @else
                                                    <span class="label label-danger">Sin verificar <i class="fa fa-times"></i> </span>
                                                @endif
                                            @endif
                                        </label>
                                        <p class="form-control-static">
                                            @if($chk_email)
                                                {{$user->email}} @if(!$user->confirmed)
                                                    @if($difusers)&nbsp;<a href="{{route('user.sendconfirm',['id'=>$user->id])}}" class="btn btn-default">Verificar?</a>@endif
                                                @endif
                                                @if($difusers)
                                                <button type="button" class="btn btn-tooltip btn-default" data-toggle="modal" data-target="#send-email-modal">
                                                    <a data-toggle="tooltip" data-placement="right" title="Cambiar email" ><i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                </button>
                                                @endif
                                            @else
                                                No se ha establecido.
                                                @if($difusers)<button type="button" class="btn btn-tooltip btn-default" data-toggle="modal" data-target="#send-email-modal">
                                                    <a data-toggle="tooltip" data-placement="right" title="Agregar email" ><i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                </button>@endif
                                            @endif
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                            <div class="pull-right">
                                @if($difusers)
                                <button class="btn btn-primary" data-toggle="modal" data-target="#change-password-modal">Cambiar contraseña</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.modals.addnames', ['user' => $user])
    @include('dashboard.modals.addemail', ['user' => $user])
    @include('dashboard.modals.changepassword', ['user' => $user])

@endsection
@push('scripts')
<script>
    $('.form-control-static').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });

    function sendAjaxForm(iduser, idform){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var form = $('form#'+idform);
        form.validate({
            lang:'{{App::getLocale()}}',
            errorElement: "p",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "help-block" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
            }
        });
        if(form.valid()){
            $.ajax({
                type: "PUT",
                url: "/dashboard/user/"+iduser+"?_token="+CSRF_TOKEN,
                data: $('form#'+idform).serialize(),
                success: function(result) {
                    if(result['code']==100) {
                        var msg="";
                            if(result['message'].email!=undefined)
                            msg=msg+result['message'].email+"\n";
                            if(result['message'].password!=undefined)
                            msg=msg+result['message'].password+"\n";
                        swal(
                        'Error!',
                        msg,
                        result['type']
                        );
                    }
                    if(result['code']==200 || result['code']==400) {
                        swal(
                        'Informe!',
                        result['message'],
                        result['type']
                        );
                    }
                    if(result['code']==300) {
                        $('.modal').modal('hide');
                        swal(
                        'Hecho!',
                        result['message'],
                        result['type']
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
    }
</script>
@endpush