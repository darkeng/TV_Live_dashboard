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
                                <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" placeholder="Nombre de usuario" minlength="6" required>
                                @if ($errors->has('username'))
                                    <div class="text-danger" role="alert">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label" for="password">Contraseña</label>
                                <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Contraseña" minlength="6" required>
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
                            <div class="form-group hidden" id="contains_div">
                                <label for="package_contains">Informacion del paquete</label>
                                <textarea id="package_contains" class="form-control" rows="10" readonly></textarea>
                            </div>
                            <div class="form-group hidden" id="line_type_div">
                                <label for="line_type">Tipo de linea</label>
                                <select name="line_type" id="line_type" class="form-control selectpicker" required>
                                </select>
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
@push('scripts')
<script>
    $(document).ready(function() { 
        $('#package_id').change(function () {
            var package_id = $( "#package_id" ).val();
            if(package_id!='') {
                $('#package_contains').empty();
                $('#line_type').empty();
                $('#contains_div').addClass('hidden');
                $('#line_type_div').addClass('hidden');
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
                $('textarea').prop('disabled', true);
                $('button').prop('disabled', true);
                $.ajax({
                    type: "GET",
                    dataType: 'JSON',
                    url: '../package/' + package_id,
                    success: function (result) {
                        if( ! jQuery.isEmptyObject( result ) ) {
                            $('#contains_div').removeClass('hidden');
                            $.each(result.contains, function (index, value) {
                                $('#package_contains').text($('#package_contains').text()+value.stream_display_name+"\n");
                            });
                            $('#line_type_div').removeClass('hidden');
                            $('#line_type').append("<option value=''>Elija el tipo de linea</option>");
                            if(result.is_trial == 1) {
                                $('#line_type').append("<option value='trial'>Prueba - Creditos: "+result.trial_credits+" - Duracion: "+result.trial_duration+" "+result.trial_duration_in+"</option>");
                            }
                            if(result.is_official == 1) {
                                $('#line_type').append("<option value='official'>Oficial - Creditos: "+result.official_credits+" - Duracion: "+result.official_duration+" "+result.official_duration_in+"</option>");
                            }
                            $('.selectpicker').selectpicker('refresh');
                        }
                    },
                    complete: function () {
                        $('input').prop('disabled', false);
                        $('select').prop('disabled', false);
                        $('textarea').prop('disabled', false);
                        $('button').prop('disabled', false);
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            } else {
                $('#package_contains').empty();
                $('#line_type').empty();
                $('#contains_div').addClass('hidden');
                $('#line_type_div').addClass('hidden');
            }
        });
    });
</script>
@endpush