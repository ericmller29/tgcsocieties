@extends('layouts.app')

@section('contents')
	<div class="container small">
		<div class="panel">
			<div class="panel-title">Login</div>
			<div class="panel-content with-padding">
				<form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
					<div class="form-input{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Email Address:</label>
						<input type="text" name="email" id="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password">Password:</label>
						<input type="password" name="password" id="password">
					</div>
					<div class="form-input text-center">
						<button type="submit" class="btn with-margin-top">Login</button>
					</div>
					<div class="text-center with-margin-top">
                        <a href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
				</form>
			</div>
		</div>
	</div>
@endsection