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

            <form method="POST" action="{{ route('password.email') }}">
                <div class="form-input">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input text-center">
                    <button type="submit" class="btn">
                        Send Password Reset Link
                    </button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
