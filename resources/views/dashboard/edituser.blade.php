@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Informacion de Cuenta</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Datos de la cuenta <strong>{{$user->username}}</strong>
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
                    <div class="row panel-profile">
                        <div class="col-md-8 col-lg-10 col-md-offset-2 col-lg-offset-1">
                            <div class="col-md-4 content-img">
                                <div class="text-center">
                                    <img class="profile-img" src="{{$user->avatar}}" alt="{{$user->username}}">
                                    <p>
                                        <a href="#" class="btn btn-info" role="button">Cambiar Imagen</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-8 content-info">
                                <div>
                                    <p class="data-field">
                                        <strong class="data-title">Nombre: </strong>
                                        <span class="data-text">{{ $user->first_name }}</span>
                                    </p>
                                    <p class="data-field">
                                        <strong class="data-title">Apellido: </strong>
                                        <span class="data-text">{{ $user->last_name }}</span>
                                    </p>
                                    <p class="data-field">
                                        <strong class="data-title">E-mail: </strong>
                                        <span class="data-text">{{ $user->email }}</span>
                                    </p>
                                    <p></p>
                                    <button class="btn btn-primary">Cambiar contraseña</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>
</script>
@endpush