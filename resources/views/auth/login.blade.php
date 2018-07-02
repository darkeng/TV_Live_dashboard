@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ __('Login') }}
                    @if ($errors->has('username'))
                        <span class="text-danger pull-right" role="alert">
                            {{ $errors->first('username') }}
                        </span>
                    @endif
                </h3>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" class="form-horizontal" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <fieldset>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="control-label col-sm-3">{{ __('UserName') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control" placeholder="Nombre de usuario" value="{{ old('username') }}" name="username" type="text" required autofocus>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label col-sm-3">{{ __('Password') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control" placeholder="*********" value="{{ old('password') }}" name="password" type="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                            
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
