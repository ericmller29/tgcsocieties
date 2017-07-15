@extends('layouts.app')

@section('contents')
<div class="container small">
    <div class="panel">
        <div class="panel-title">Register</div>
        <div class="panel-content with-padding">
            <form method="POST" action="{{ route('register') }}">

                <div class="form-input{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="gamer_tag">Gamer Tag:</label>
                    <input id="gamer_tag" type="text" class="form-control" name="gamer_tag" value="{{ old('gamer_tag') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input{{ $errors->has('platform') ? ' has-error' : '' }}">
                    <label for="platform">Platform:</label>
                    <div class="select">
                        <select name="platform" id="platform">
                            <option value="PC"{{ old('platform') == 'PC' ? ' selected' : '' }}>PC</option>
                            <option value="PS4"{{ old('platform') == 'PS4' ? ' selected' : '' }}>PS4</option>
                            <option value="Xbox One"{{ old('platform') == 'Xbox One' ? ' selected' : '' }}>Xbox One</option>
                        </select>
                    </div>

                    @if ($errors->has('platform'))
                        <span class="help-block">
                            <strong>{{ $errors->first('platform') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address:</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-input">
                    <label for="password-confirm">Confirm Password:</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required>
                </div>

                <div class="form-input text-center">
                    <button type="submit" class="btn">
                        Register
                    </button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
