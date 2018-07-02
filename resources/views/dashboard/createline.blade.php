@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Crear Nueva Linea</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Datos para la nueva linea
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
                    <form action="{{route('line.store')}}" method="POST" role="form">
                        @csrf
                        <fieldset>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label class="control-label" for="username">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" placeholder="Nombre de usuario" min="6" required>
                                @if ($errors->has('username'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label" for="password">Contraseña</label>
                                <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Contraseña" min="6" required>
                                @if ($errors->has('password'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('package_id') ? ' has-error' : '' }}">
                                <label class="control-label" for="package_id">Paquete</label>
                                <select name="package_id" id="package_id" class="form-control selectpicker" required>
                                    <option value="">Seleccione un paquete</option>
                                    @foreach ($packages as $package)
                                        <option value="{{$package->package_id}}"> {{$package->name}} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('package_id'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('package_id') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="reseller_notes">Notas</label>
                                <textarea rows="5" class="form-control" id="reseller_notes" name="reseller_notes"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Crear Linea</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection