@extends('layouts.app')

@section('contents')
	<div class="container small">
		<div class="panel">
			<div class="panel-title">New Society</div>
			<div class="panel-content with-padding">
                @if(session('message'))

                @endif
                <form method="POST" action="{{ route('my.societies.new') }}">
                    <div class="form-input{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Society Name:</label>
                        <input type="text" name="name" id="name">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input{{ $errors->has('platform') ? ' has-error' : '' }}">
                        <label for="platform">Platform:</label>
                        <div class="select">
                            <select name="platform" id="platform">
                                <option value="PC"{{ (old('platform') == 'PC') ? 'selected' : '' }}>PC</option>
                                <option value="PS4"{{ (old('platform') == 'PS4') ? 'selected' : '' }}>PS4</option>
                                <option value="Xbox One"{{ (old('platform') == 'Xbox One') ? 'selected' : '' }}>Xbox One</option>
                            </select>
                            <i class="fa fa-caret-down"></i>
                        </div>
                        @if ($errors->has('platform'))
                            <span class="help-block">
                                <strong>{{ $errors->first('platform') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input text-center">
                        <button type="submit" class="btn">Create Society</button>
                    </div>
                    @if(isset($_GET['ref']))
                    <input type="hidden" name="ref" value="{{ $_GET['ref'] }}">
                    @endif
                    {{ csrf_field() }}
                </form>
            </div>
		</div>
	</div>
@endsection