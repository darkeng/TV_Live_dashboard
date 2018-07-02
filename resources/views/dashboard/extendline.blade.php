@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Extender Suscripci&oacute;n</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Seleccione una linea para extender
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
                    <form action="{{route('line.extending')}}" method="POST" role="form">
                        @csrf
                        <fieldset>
                            <div class="form-group{{ $errors->has('line_id') ? ' has-error' : '' }}">
                                <label class="control-label" for="line_id">Buscar Linea</label>
                                <select name="line_id" id="line_id" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Seleccione una linea</option>
                                    @foreach ($lines as $line)
                                        <option value="{{$line->line_id}}" data-tokens="{{$line->username}} {{$line->password}}">{{$line->username}} - {{$line->password}} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('line_id'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('line_id') }}
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
                                <label class="control-label" for="package_info">Informacion del paquete</label>
                                <textarea rows="7" class="form-control" id="package_info" name="package_info" readonly></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Extender</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection