@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Crear Nuevo Usuario</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Datos para el nuevo usuario
                </div>
                <div class="panel-body">
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
                    <form action="{{route('user.store')}}" method="POST" role="form">
                        @csrf
                        <fieldset>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label class="control-label" for="username">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" placeholder="Nombre de usuario" minlength="6" required autofocus>
                                @if ($errors->has('username'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label" for="password">Contraseña</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Contraseña" minlength="6" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="keyGenerate(this)"><i class="fa fa-refresh"></i>
                                            Generar?
                                        </button>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label class="control-label" for="role">Rol</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">Elige un rol para el usuario</option>
                                    <option value="User" class="text-success">Vendedor</option>
                                    <option value="Admin" class="text-danger">Administrador</option>class="btn btn-"
                                </select>
                                @if ($errors->has('role'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('role') }}
                                    </div>
                                @endif
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>
    function keyGenerate(el)
    {
        var key=Math.random().toString(36).slice(-8);
        $(el).parent().siblings('input').val(key);
    }
    $(document).ready(function() { 
    });
</script>
@endpush