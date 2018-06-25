@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ __('Login') }}</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" class="form-horizontal" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <fieldset>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label col-sm-3">{{ __('E-Mail Address') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control" placeholder="example@domain.com" value="{{ old('email') }}" name="email" type="email" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <div class="alert alert-danger col-sm-9 col-sm-offset-3" role="alert">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label col-sm-3">{{ __('Password') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control" placeholder="*********" value="{{ old('password') }}" name="password" type="password" required>
                            </div>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger col-sm-9 col-sm-offset-3" role="alert">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
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
