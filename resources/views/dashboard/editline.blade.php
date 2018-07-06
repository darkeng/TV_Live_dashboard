@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Editar Linea</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nevos datos para la linea <strong>{{$line->username}}</strong>
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
                    <form action="{{route('line.update', ['id'=>$line->id])}}" method="POST" role="form">
                        @csrf
                        <fieldset>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label" for="password">Contraseña</label>
                                <input type="text" class="form-control" id="password" name="password" value="{{$line->password}}" placeholder="Contraseña" minlength="6" required>
                                @if ($errors->has('password'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="reseller_notes">Notas</label>
                                <textarea rows="5" class="form-control" id="reseller_notes" name="reseller_notes">{{$line->reseller_notes}}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Actualizar Linea</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection