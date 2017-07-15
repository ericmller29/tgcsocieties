@extends('layouts.app')

@section('contents')
<div class="container small">
    <div class="panel">
        <div class="panel-title">Reset Password</div>

        <div class="panel-content with-padding">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form  method="POST" action="{{ route('password.request') }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address:</label>
                    <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Confirm Password:</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input text-center">
                    <button type="submit" class="btn with-margin-top">
                        Reset Password
                    </button>
                </div>
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">
            </form>
        </div>
    </div>
</div>
@endsection
